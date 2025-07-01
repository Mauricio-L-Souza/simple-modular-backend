<?php

namespace Core\Shared\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckUserAccesses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hasAccess = $request->user()
            ->accesses()
            ->where('name', $request->route()->getName())
            ->exists();

        if (!$hasAccess) {
            throw new HttpException(422, 'Você não está habilitado a acessar esta rota');
        }

        return $next($request);
    }
}
