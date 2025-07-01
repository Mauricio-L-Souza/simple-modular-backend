<?php

namespace Core\Products\Exceptions;

use Exception;

class ProductHttpClientException extends Exception
{
    static function serviceBaseUrlNotSetted(): self
    {
        return new self("The product base url environment variable not setted");
    }
}
