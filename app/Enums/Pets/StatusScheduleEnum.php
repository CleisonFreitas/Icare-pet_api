<?php

namespace App\Enums\Pets;

enum StatusScheduleEnum: string
{
    case OPEN = 'OPEN';
    case PENDING = 'PENDING';
    case CONFIRMED = 'CONFIRMED';
    case CANCELLED = 'CANCELLED';
    case COMPLETED = 'COMPLETED';
    case RESCHEDULED = 'RESCHEDULED';

    public function description(): string
    {
        return match ($this) {
            self::OPEN => 'Agendamento em aberto',
            self::PENDING => 'Agendamento pendente',
            self::CONFIRMED => 'Agendamento confirmado',
            self::CANCELLED => 'Agendamento cancelado',
            self::COMPLETED => 'Agendamento concluído',
            self::RESCHEDULED => 'Agendamento reagendado',
        };
    }
}
