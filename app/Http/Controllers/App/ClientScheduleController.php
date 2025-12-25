<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Requests\App\ScheduleManageRequest;
use App\Http\Requests\App\ScheduleRequest;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Models\Client\Client;
use App\Models\Pet\Pet;
use App\Models\Pet\Schedule;
use App\Services\Client\ClientScheduleManagementService;
use App\Services\Client\ClientScheduleCreateService;
use App\Services\Client\ClientScheduleDetailsService;
use App\Services\Client\ClientScheduleListService;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ClientScheduleController
{
    /**
     * Responsible for listing the schedules of customers.
     * 
     * @param string $clientId
     * @param ClientScheduleListService $service
     * @return JsonResponse
     */
    public function index(string $clientId, ClientScheduleListService $service): JsonResponse
    {
        /** @var Client */
        $client = Client::findByKey($clientId);
        $schedules = $service->list($client);

        return response()->json(ScheduleResource::collection($schedules));
    }

    /**
     * Responsible for returning details of schedule.
     * 
     * @param string $clientId
     * @param string $scheduleId
     * @return JsonResponse
     */
    public function details(
        string $clientId,
        string $scheduleId,
        ClientScheduleDetailsService $service
    ): JsonResponse
    {
        $schedule = $service->getDetails($clientId, $scheduleId);
        return response()->json(new ScheduleResource($schedule));
    }

    /**
     * Responsbile for scheduling the appointments
     * @param string $clientId
     * @param string $petId
     * @param ScheduleRequest $request
     * @param ClientScheduleCreateService $service
     * @return JsonResponse
     */
    public function schedule(
        string $clientId,
        string $petId,
        ScheduleRequest $request,
        ClientScheduleCreateService $service
    ): JsonResponse
    {
        /** @var Client */
        $client = Client::findByKey($clientId);
        $pet = Pet::findByKey($petId);
        $response = $service->create($client, $pet, $request->validated());
        return response()->json(new ScheduleResource($response));
    }

    /**
     * Responsible for cancelling/rescheduling the appointments.
     *  
     * @param string $clientId
     * @param string $scheduleId
     * @return JsonResponse
     */
    public function manage(
        string $clientId,
        string $scheduleId,
        ClientScheduleManagementService $service,
        ScheduleManageRequest $request,
    ): JsonResponse
    {
        /** @var Client $client*/
        $client = Client::findByKey($clientId);
        $schedule = Schedule::findByKey($scheduleId);

        $newSchedule = $service->manage($client,$schedule, $request->validated());
        return response()->json(new ScheduleResource($newSchedule));
    }
}