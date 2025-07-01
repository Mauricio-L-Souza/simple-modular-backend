<?php

namespace Core\Shared\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckBaseApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $baseApiToken = config('secrets.base_api_token');

        if ($baseApiToken !== $request->header('X-API-TOKEN')) {
            throw new HttpException(422, 'O token informado está inválido!');
        }

        return $next($request);
    }
}
