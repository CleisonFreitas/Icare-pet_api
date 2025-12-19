<?php

namespace App\Enums\Financial;

enum PaymentMethodEnum: string
{
    case CREDIT_CARD = 'CREDIT_CARD';
    case DEBIT_CARD = 'DEBIT_CARD';
    case PIX = 'PIX';
    case BANK_TRANSFER = 'BANK_TRANSFER';

    public function description(): string
    {
        return match($this) {
            self::CREDIT_CARD => 'Cartão de Crédito',
            self::DEBIT_CARD => 'Cartão de Débito',
            self::PIX => 'Pix',
            self::BANK_TRANSFER => 'Transferência Bancária',
        };
    }
}