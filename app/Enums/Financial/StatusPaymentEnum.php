<?php

namespace App\Enums\Financial;

enum StatusPaymentEnum: string
{
    case PENDING = 'PENDING';
    case PAID = 'PAID';
    case CANCELLED = 'CANCELLED';

    public function description(): string
    {
        return match($this) {
            self::PENDING => 'Pendente',
            self::PAID => 'Pago',
            self::CANCELLED => 'Cancelado',
        };
    }
}