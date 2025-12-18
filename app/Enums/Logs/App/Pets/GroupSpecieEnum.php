<?php

namespace App\Enums\Logs\App\Pets;

enum GroupSpecieEnum: string
{
    case MAMIFERO = 'MAMIFERO';
    case PASSARO = 'PASSARO';
    case REPTILS = 'REPTILS';
    case PEIXE = 'PEIXE';
    case AMFIBIO = 'AMFIBIO';
    case INSETOS = 'INSETOS';

    public function description(): string
    {
        return match ($this) {
            self::MAMIFERO => 'Mamífero',
            self::PASSARO => 'Ave',
            self::REPTILS => 'Réptil',
            self::PEIXE => 'Peixe',
            self::AMFIBIO => 'Anfíbio',
            self::INSETOS => 'Inseto',
        };
    }
}