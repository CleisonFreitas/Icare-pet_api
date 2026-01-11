<?php

namespace App\Enums\Logs\User;


enum UserActivityLogsEnum: string
{
    case USUARIO_REGISTROU_PETS_CLIENTE = 'USUARIO_REGISTROU_PETS_CLIENTE';

    public function description(): string
    {
        return match($this) {
            self::USUARIO_REGISTROU_PETS_CLIENTE => 'Usuário registrou os pets do cliente'
        };
    }
}