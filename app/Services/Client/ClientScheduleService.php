<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Enums\Pets\StatusServiceEnum;
use App\Facades\SaveRecordFacade;
use App\Models\Client\Client;
use App\Models\Pet\Schedule;

class ClientScheduleService
{
    /**
     * Service responsible for scheduling customer appointments.
     *
     * @param Client $client
     * @param array $data
     * @return Schedule
     */
    public function create(Client $client, array $data): Schedule
    {
        $schedule = data_get($data, 'schedule_id');
        $model = Schedule::find($schedule);
        $newData = [
            'pet_id' => data_get($data, 'pet_id'),
            'client_id' => $client->id,
            'status' => StatusServiceEnum::PENDING
        ];

        return SaveRecordFacade::save($model, $newData);
    }
}