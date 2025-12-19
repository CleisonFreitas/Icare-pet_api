<?php

namespace App\Enums\Pets;

enum GroupSpecieEnum: string
{
    case MAMIFERO = 'MAMIFERO';
    case PASSARO = 'PASSARO';
    case REPTIL = 'REPTIL';
    case PEIXE = 'PEIXE';
    case AMFIBIO = 'AMFIBIO';
    case INSETO = 'INSETO';

    public function description(): string
    {
        return match ($this) {
            self::MAMIFERO => 'Mamífero',
            self::PASSARO => 'Ave',
            self::REPTIL => 'Réptil',
            self::PEIXE => 'Peixe',
            self::AMFIBIO => 'Anfíbio',
            self::INSETO => 'Inseto',
        };
    }
}
