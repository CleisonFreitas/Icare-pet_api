<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\Client;
use Laravel\Sanctum\PersonalAccessToken;

class ClientExpiresTokenService
{
    /**
     * Expires all tokens for the given client.
     * @param int $clientId
     * @return void
     */
    public function expireAllTokensForClient(int $clientId): void
    {
        $clientClass = Client::class;

        /** @var PersonalAccessToken[] $tokens */
        $tokens = PersonalAccessToken::where('tokenable_type', $clientClass)
            ->where('tokenable_id', $clientId)
            ->get();

        foreach ($tokens as $token) {
            $token->expires_at = now()->subMinute();
            $token->save();
        }
    }
}