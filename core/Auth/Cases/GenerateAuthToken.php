<?php

namespace Core\Auth\Cases;

use App\Models\User;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GenerateAuthToken
{
    public function execute(string $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new HttpException(422, 'Usuário não encontrado!');
        }

        return ['token' => $user->createToken(Str::random())->plainTextToken];
    }
}
