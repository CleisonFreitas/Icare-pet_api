<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Requests\App\ScheduleRequest;
use App\Models\Client\Client;
use App\Services\Client\ClientScheduleService;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ClientScheduleController
{
    public function schedule(
        string $clientId,
        ScheduleRequest $request,
        ClientScheduleService $service
    ): JsonResponse
    {
        /** @var Client */
        $client = Client::findByKey($clientId);
        $response = $service->create($client, $request->validated());
        return response()->json($response);
    }
}