<?php
namespace App\Enums\Client;

enum ContactTypeEnum: string
{
    case EMAIL = 'EMAIL';
    case PHONE = 'PHONE';
    case OTHER = 'OTHER';

    public function description(): string
    {
        return match($this) {
            self::EMAIL => 'Email',
            self::PHONE => 'Telefone',
            self::OTHER => 'Outro'
        };
    }

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}