<?php

namespace App\Enums\Financial;

enum TransactionTypeEnum: string
{
    case INCOME = 'INCOME';
    case EXPENSE = 'EXPENSE';

    public function description(): string
    {
        return match($this) {
            self::INCOME => 'Receita',
            self::EXPENSE => 'Despesa',
        };
    }
}