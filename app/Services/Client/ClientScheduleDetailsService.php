<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Models\Client\Client;
use App\Models\Pet\Schedule;

class ClientScheduleDetailsService
{
    public function getDetails(string $clientId, string $scheduleId): Schedule
    {
        /** @var Client */
        $client = Client::findByKey($clientId);
        $schedule = Schedule::findByKey($scheduleId);
        $this->runValidations($client, $schedule);
        return $schedule;
    }

    private function runValidations(Client $client, Schedule $schedule): void
    {
        if ($schedule->client_id !== $client->id) {
            throw new \Exception('O agendamento não está vinculado à essa conta!');
        }
    }
}