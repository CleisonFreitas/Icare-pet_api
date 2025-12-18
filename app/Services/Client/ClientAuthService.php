<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\Client;
use Illuminate\Support\Facades\Hash;

class ClientAuthService
{
    public function __construct(
        private readonly ClientExpiresTokenService $clientExpiresTokenService
    ) {}

    /**
     * It allows a client to log in.
     * @param array $data
     * @param Client|null $client
     * @throws \InvalidArgumentException
     * 
     * @return array{client: Client, token: string}
     */
    public function login(array $data, ?Client $client): array
    {
        if (!$client || ! Hash::check($data['password'], $client->password)) {
            throw new \InvalidArgumentException('Credenciais inválidas.');
        }
        // Expire all previous tokens
        $this->clientExpiresTokenService->expireAllTokensForClient($client->id);
        $tokenName = $client->id . '_' . now()->timestamp;
        $token = $client->createToken(
            $tokenName,
            ['client'],
            now()->endOfDay(),
        )->plainTextToken;

        return [
            'client' => $client,
            'token' => $token
        ];
    }
}
