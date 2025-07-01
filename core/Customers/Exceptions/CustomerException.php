<?php

namespace App\Exceptions;

use Core\Shared\Exception\BaseException;

class CustomerException extends BaseException
{
    public static function customerEmailAlreadyExists(): self
    {
        return new self('Já foi cadastrado um cliente com este mesmo e-mail', 422);
    }
}
