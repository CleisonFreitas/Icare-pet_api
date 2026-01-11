<?php

namespace App\Events\Client;

use App\Enums\Logs\User\UserActivityLogsEnum;

class ClientPetSaved
{
     public SaveLog $info;

    public function __construct()
    {
        $this->info = SaveLog::create(
            logName: UserActivityLogsEnum::USUARIO_REGISTROU_PETS_CLIENTE->value,
            description: UserActivityLogsEnum::USUARIO_REGISTROU_PETS_CLIENTE->description(),
        );
    }
}