<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Events\App\UserLogged;
use App\Models\Client\Client;
use App\Services\Client\ClientAuthService;
use App\Services\Client\ClientExpiresTokenService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class ClientAuthController
{
    public function __construct(
        private readonly ClientAuthService $clientAuthService,
    ) {}

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        $client = Client::where('email', $data['email'])->first();
        $response = $this->clientAuthService->login($data, $client);
        event(new UserLogged($client));
        return response()->json($response);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthdate' => ['nullable', 'date'],
        ]);

        $client = Client::create($data);
        $response = $this->clientAuthService->login($data, $client);

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function me(Request $request)
    {
        /** @var Client $client */
        $client = $request->user();

        return response()->json([
            'client' => $client,
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()?->currentAccessToken();
        if ($token) {
            $token->delete();
        }

        return response()->json(['resposta' => 'Deslogou do sistema.']);
    }
}
