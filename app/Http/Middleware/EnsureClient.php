<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Client\Client;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureClient
{
    /**
     * Allow only requests authenticated as a Client model or with a token that has the 'client' ability.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user === null) {
            return response()->json([
                'resposta' => 'Não autenticado.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->currentAccessToken();

        if ($token->expires_at->lessThan(now())) {
            return response()->json([
                'resposta' => 'Token expirado.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // If token has 'client' ability allow
        if ($token->can('client')) {
            return $next($request);
        }

        // Or if the authenticated user is an instance of the Client model
        $clientClass = Client::class;
        if ($user instanceof $clientClass) {
            return $next($request);
        }

        return response()->json(['resposta' => 'Você não tem acesso.'], Response::HTTP_FORBIDDEN);
    }
}
