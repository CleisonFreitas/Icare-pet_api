<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Requests\App\RegisterRequest;
use App\Models\Client\Client;
use App\Services\Client\ClientPetSave;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ClientPetController
{
    /**
     * This endpoint will be responsible for completing
     * the register of the customer and allowing him to access
     * the services.
     * 
     * @param string $clientId
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(
        string $clientId,
        RegisterRequest $request,
        ClientPetSave $service
    ): JsonResponse
    {
        /** @var Client */
        $client = Client::findByKey($clientId);

        $service->register($client, $request->validated());
        return response()->json('Registro completo!', Response::HTTP_CREATED);
    }
}