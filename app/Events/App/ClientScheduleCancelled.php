<?php

declare(strict_types=1);

namespace App\Events\App;

use App\Enums\Logs\App\ClientActivityLogsEnum;
use App\Events\Client\SaveLog;
use App\Models\Pet\Schedule;

class ClientScheduleCancelled
{
    public SaveLog $info;

    public function __construct(private readonly Schedule $schedule)
    {
        $this->info = SaveLog::create(
            logName: ClientActivityLogsEnum::APP_CLIENTE_CANCELOU_CONSULTA->value,
            description: ClientActivityLogsEnum::APP_CLIENTE_CANCELOU_CONSULTA->description(),
            details: [
                'performed_key' => $schedule->id,
                'performed_on' => $schedule::class,
            ]
        );
    }
}