<?php

namespace App\Enums\Logs\App;

enum ClientActivityLogsEnum: string
{
    case APP_CLIENTE_LOGOU_NO_SISTEMA = 'APP_CLIENTE_LOGOU_NO_SISTEMA';
    case APP_CLIENTE_SAIU_DO_SISTEMA = 'APP_CLIENTE_SAIU_DO_SISTEMA';

    public function description(): string
    {
        return match($this) {
            self::APP_CLIENTE_LOGOU_NO_SISTEMA => 'O cliente logou no sistema',
            self::APP_CLIENTE_SAIU_DO_SISTEMA => 'O cliente saiu do sistema',
        };
    }
}