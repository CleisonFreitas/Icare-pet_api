<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Enums\Pets\StatusScheduleEnum;
use App\Facades\SaveRecordFacade;
use App\Models\Client\Client;
use App\Models\Pet\Pet;
use App\Models\Pet\Schedule;

class ClientScheduleService
{
    /**
     * Service responsible for scheduling customer appointments.
     *
     * @param Client $client
     * @param Pet $pet
     * @param array $data
     * @return Schedule
     */
    public function create(Client $client, Pet $pet, array $data): Schedule
    {
        $schedule = data_get($data, 'schedule_id');
        $model = Schedule::find($schedule);

        if (!$pet->active) {
            throw new \Exception('O pet informado não está ativo');
        }
        $this->validatingSchedule($model, $client);
        $newData = [
            'pet_id' => $pet->id,
            'client_id' => $client->id,
            'status' => StatusScheduleEnum::PENDING
        ];

        return SaveRecordFacade::save($model, $newData);
    }

    private function validatingSchedule(Schedule $schedule, Client $client): void
    {
        if (!$schedule->isOpen()) {
            throw new \Exception('Dia/horário informado não é válido');
        }

        $existingSchedule = $client->schedules()
            ->where('scheduled_date', $schedule->scheduled_date)
            ->whereNot('status', StatusScheduleEnum::OPEN)
            ->exists();

        if ($existingSchedule) {
            throw new \Exception('Foi encontrado outro agendamento no mesmo horário');
        }
    }
}