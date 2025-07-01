<?php

namespace App\Exceptions;

use Exception;

class FavoriteProductException extends Exception
{
    public static function invalidProductProvided(): self
    {
        return new self('Este produto não pode ser favoritado! Produto não cadastrado.');
    }

    public static function productNotAvailable(): self
    {
        return new self('Este produto não está mais disponível!');
    }

    public static function customerFavoriteAlreadyExists(): self
    {
        return new self('Este produto já foi favoritado para este cliente');
    }
}
