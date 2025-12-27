<?php

namespace App\Listeners\Client;

use App\Events\Client\SaveLog;
use App\Models\Logs\ActionLog;

class ListenSaveLog
{
    public function handle(SaveLog $event): void
    {
        ActionLog::create([
            'log_name' => $event->getLogName(),
            'description' => $event->getDescription(),
            'performed_by' => $event->getPerformedBy(),
            'performed_type' => $event->getPerformedType(),
            'properties' => array_merge($event->getDetails(), [
                'ip' => request()->ip(),
                'device' => request()->userAgent(),
                'host' => request()->schemeAndHttpHost(),
            ]),
        ]);
    }
}
