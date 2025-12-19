<?php

namespace App\Enums\Pets;

enum SpecieNameEnum: string
{
    case DOG = 'DOG';
    case CAT = 'CAT';
    case RABBIT = 'RABBIT';
    case GUINEA_PIG = 'GUINEA_PIG';
    case HAMSTER = 'HAMSTER';
    case CHINCHILLA = 'CHINCHILLA';
    case FERRET = 'FERRET';

    case PARROT = 'PARROT';
    case COCKATIEL = 'COCKATIEL';
    case BUDGIE = 'BUDGIE';
    case CANARY = 'CANARY';
    case COCKATOO = 'COCKATOO';

    case TURTLE = 'TURTLE';
    case CAGADO = 'CAGADO';
    case IGUANA = 'IGUANA';
    case GECKO = 'GECKO';
    case NON_VENOMOUS_SNAKE = 'NON_VENOMOUS_SNAKE';

    case FISH = 'FISH';
    case FROG = 'FROG';
    case TOAD = 'TOAD';
    case AXOLOTL = 'AXOLOTL';

    public function description(): string
    {
        return match($this) {
            self::DOG => 'Cão',
            self::CAT => 'Gato',
            self::RABBIT => 'Coelho',
            self::GUINEA_PIG => 'Porquinho-da-índia',
            self::HAMSTER => 'Hamster',
            self::CHINCHILLA => 'Chinchila',
            self::FERRET => 'Furão',

            self::PARROT => 'Papagaio',
            self::COCKATIEL => 'Calopsita',
            self::BUDGIE => 'Periquito',
            self::CANARY => 'Canário',
            self::COCKATOO => 'Cacatua',

            self::TURTLE => 'Tartaruga',
            self::CAGADO => 'Cágado',
            self::IGUANA => 'Iguana',
            self::GECKO => 'Gecko',
            self::NON_VENOMOUS_SNAKE => 'Cobra (não venenosa)',

            self::FISH => 'Peixe',
            self::FROG => 'Rã',
            self::TOAD => 'Sapo',
            self::AXOLOTL => 'Axolote',
        };
    }

    public function slug(): string
    {
        return match($this) {
            self::DOG => 'cao',
            self::CAT => 'gato',
            self::RABBIT => 'coelho',
            self::GUINEA_PIG => 'porquinho-da-india',
            self::HAMSTER => 'hamster',
            self::CHINCHILLA => 'chinchila',
            self::FERRET => 'furao',

            self::PARROT => 'papagaio',
            self::COCKATIEL => 'calopsita',
            self::BUDGIE => 'periquito',
            self::CANARY => 'canario',
            self::COCKATOO => 'cacatua',

            self::TURTLE => 'tartaruga',
            self::CAGADO => 'cagado',
            self::IGUANA => 'iguana',
            self::GECKO => 'gecko',
            self::NON_VENOMOUS_SNAKE => 'cobra-nao-venenosa',

            self::FISH => 'peixe',
            self::FROG => 'ra',
            self::TOAD => 'sapo',
            self::AXOLOTL => 'axolote',
        };
    }
}