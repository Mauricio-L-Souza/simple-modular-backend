<?php

namespace Core\Shared\Exception;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseException extends Exception
{
    function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public function report(): void {}

    public function render(Request $request): Response
    {
        return response([
            'message' => $this->message,
            'error' => self::class
        ], $this->code);
    }
}
