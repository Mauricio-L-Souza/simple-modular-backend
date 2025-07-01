<?php

namespace Core\Auth\Cases;

use App\Models\User;
use Illuminate\Support\Str;
use Core\Auth\Payloads\UserPayload;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CreateUser
{
    public function execute(UserPayload $payload)
    {
        $userAlreadyExists = User::where('email', $payload->email)->exists();
        if ($userAlreadyExists) {
            throw new HttpException(422, 'Este usuário já foi utilizado, verifique o endereço de e-mail e tente novamente!');
        }

        $user = User::create([
            'name' => $payload->name,
            'email' => $payload->email,
            'password' => Hash::make(Str::random())
        ]);

        foreach ($payload->accesses as $access) {
            $user->accesses()->create([
                'name' => $access->value
            ]);
        }

        return ['created' => true];
    }
}
