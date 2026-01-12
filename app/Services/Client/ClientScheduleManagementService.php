<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Enums\Pets\StatusScheduleEnum;
use App\Models\Client\Client;
use App\Models\Pet\Schedule;
use Illuminate\Support\Facades\DB;

class ClientScheduleManagementService
{
    public function manage(
        Client $client,
        Schedule $schedule,
        array $data
    ): Schedule {
        $reschedule = (bool) data_get($data, 'reschedule', false);
        $motive = data_get($data, 'motive');

        $this->runValidations($client, $schedule, $motive, $reschedule);

        DB::beginTransaction();
        $schedule->status = StatusScheduleEnum::RESCHEDULED;
        $schedule->save();
        $schedule->fresh();

        // TODO: add notification and creating notes.
        DB::commit();

        return $schedule;
    }

    private function runValidations(
        Client $client,
        Schedule $schedule,
        ?string $motive,
        bool $reschedule
    ):void
    {
        $appointmentBelongsToClient = $schedule->client_id == $client->id;

        if (!$appointmentBelongsToClient) {
            throw new \Exception(
                'Agendamento informado inválido ou pertence a outro cliente'
            );
        }

        if (!in_array($schedule->status, [
            StatusScheduleEnum::PENDING,
            StatusScheduleEnum::CONFIRMED,
        ])) {
            throw new \Exception(
                'Esse serviço não está mais ápto para ser reagendado! Por favor, entrar em contato com o nosso suporte'
            );
        }

        if (!$motive) {
            $message = sprintf(
                'É obrigatório informar o motivo do %s',
                'reagendamento'
            );
            throw new \Exception($message);
        }
    }
}
