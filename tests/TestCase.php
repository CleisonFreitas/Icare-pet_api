<?php

namespace Tests;

use App\Models\Client\Client;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;

    public function actionAsClient(): Client
    {
        $client = Client::factory()->create();
        $tokenName = $client->id . '_' . now()->timestamp;
        $client->createToken(
            $tokenName,
            ['client'],
            now()->endOfDay(),
        )->plainTextToken;
        Sanctum::actingAs($client);

        return $client;
    }
}
