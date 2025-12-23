<?php

namespace App\Http\Middleware;

use App\Models\Client\Client;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientValidMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Client */
        $client = $request->user();

        if (!$client->register_completed || !$client->active) {
            throw new \Exception("Ação não autorizada! Entre em contato com o nosso suporte");
        }
        return $next($request);
    }
}
