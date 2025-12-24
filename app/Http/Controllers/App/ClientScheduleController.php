<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Requests\App\ScheduleRequest;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Models\Client\Client;
use App\Models\Pet\Pet;
use App\Services\Client\ClientScheduleService;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ClientScheduleController
{
    public function schedule(
        string $clientId,
        string $petId,
        ScheduleRequest $request,
        ClientScheduleService $service
    ): JsonResponse
    {
        /** @var Client */
        $client = Client::findByKey($clientId);
        $pet = Pet::findByKey($petId);
        $response = $service->create($client, $pet, $request->validated());
        return response()->json(new ScheduleResource($response));
    }
}