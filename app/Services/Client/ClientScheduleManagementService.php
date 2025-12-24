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
    ): Schedule
    {
        $reschedule = (bool) data_get($data, 'reschedule', false);
        $motive = data_get($data, 'motive');

        $this->makeValidations($client, $schedule, $motive, $reschedule);

        DB::beginTransaction();
        $schedule->status = $reschedule
            ? StatusScheduleEnum::RESCHEDULED
            : StatusScheduleEnum::CANCELLED;
        $schedule->save();
        $schedule->fresh();

        // TODO: add notification and creating notes.
        DB::commit();

        return $schedule;
    }

    private function makeValidations(
        Client $client,
        Schedule $schedule,
        ?string $motive,
        bool $reschedule
    ): void
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
                'Esse serviço não está mais ápto para ser reagendado/cancelado! Por favor, entrar em contato com o nosso suporte'
            );
        }

        if (!$motive) {
            $message = sprintf(
                'É obrigatório informar o motivo do %s',
                $reschedule ? 'cancelamento' : 'reagendamento'
            );
            throw new \Exception($message);
        }
    }
}
