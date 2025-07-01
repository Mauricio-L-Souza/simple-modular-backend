<?php

namespace Core\Auth\Controllers;

use Illuminate\Http\Request;
use Core\Auth\Cases\CreateUser;
use Core\Auth\Payloads\UserPayload;
use App\Http\Controllers\Controller;
use Core\Auth\Cases\GenerateAuthToken;

class AuthController extends Controller
{
    public function createUser(Request $request, CreateUser $case)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'accesses' => 'required|array'
        ]);

        return $case->execute(new UserPayload(
            name: $data['name'],
            email: $data['email'],
            rawAccesses: $data['accesses']
        ));
    }

    public function generateToken(Request $request, GenerateAuthToken $case)
    {
        $data = $request->validate([
            'email' => 'required|email'
        ]);

        return $case->execute($data['email']);
    }
}
