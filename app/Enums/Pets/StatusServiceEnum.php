<?php

namespace App\Enums\Pets;

enum StatusServiceEnum: string
{
    case OPEN = 'OPEN';
    case PENDING = 'PENDING';
    case CONFIRMED = 'CONFIRMED';
    case CANCELLED = 'CANCELLED';
    case COMPLETED = 'COMPLETED';

    public function description(): string
    {
        return match ($this) {
            self::PENDING => 'Agendamento Pendente',
            self::CONFIRMED => 'Agendamento Confirmado',
            self::CANCELLED => 'Agendamento Cancelado',
            self::COMPLETED => 'Agendamento Concluído',
        };
    }
}
