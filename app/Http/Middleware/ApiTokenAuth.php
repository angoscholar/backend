<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next, ?string $role = null): Response
    {
        $header = $request->bearerToken() ?: $request->header('X-API-Token');

        if (! $header) {
            return response()->json(['error' => 'Token em falta'], 401);
        }

        $user = User::where('api_token', $header)->first();

        if (! $user) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        if ($role && $user->role !== $role) {
            return response()->json(['error' => 'Sem permissão'], 403);
        }

        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
