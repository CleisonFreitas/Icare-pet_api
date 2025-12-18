<?php

namespace App\Events\App;

use App\Enums\Logs\App\ClientActivityLogsEnum;
use App\Models\Client\Client;
use App\Models\Logs\ActionLog;
use Illuminate\Support\Facades\Event;

class UserLogged extends Event
{
    public function __construct(private readonly Client $client)
    {
        ActionLog::create([
            'log_name' => ClientActivityLogsEnum::APP_CLIENTE_LOGOU_NO_SISTEMA->value,
            'description' => ClientActivityLogsEnum::APP_CLIENTE_LOGOU_NO_SISTEMA->description(),
            'performed_type' => Client::class,
            'performed_by' => $this->client->id,
        ]);
    }
}