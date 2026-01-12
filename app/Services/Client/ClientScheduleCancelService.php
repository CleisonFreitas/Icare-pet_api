<?php

declare(strict_types=1);

namespace App\Services\Client;

use App\Enums\Pets\StatusScheduleEnum;
use App\Models\Client\Client;
use App\Models\Pet\Schedule;
use App\Models\User\User;
use LogicException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientScheduleCancelService
{
    /**
     * Responsible for cancelling the schedule.
     *
     * @param Client $client
     * @param Schedule $schedule
     * @param User|null $usuario
     * @return Schedule
     * 
     * @throws NotFoundHttpException
     * @throws LogicException
     */
    public function cancel(
        Client $client,
        Schedule $schedule,
        ?User $usuario = null
    ): Schedule
    {
        $this->runValidations($client, $schedule, $usuario);

        $schedule->cancel_date = now();
        $schedule->status = StatusScheduleEnum::CANCELLED;
        $schedule->save();

        return $schedule->refresh();
    }

    private function runValidations(Client $client, Schedule $schedule, ?User $usuario): void
    {
        if (!$client->schedules()
            ->where('id', $schedule->id)
            ->exists()
        ) {
            $message = $usuario == null
                ? "Consulta não encontrada!"
                : "Consulta não vinculada à esse cliente";

            throw new NotFoundHttpException($message);
        }

        if ($schedule->isCanceled()) {
            throw new LogicException("A consulta já está cancelada");
        }
    }
}
