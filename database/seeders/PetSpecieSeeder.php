<?php

namespace Database\Seeders;

use App\Enums\Logs\App\Pets\GroupSpecieEnum;
use App\Models\Pet\Specie;
use Illuminate\Database\Seeder;

class PetSpecieSeeder extends Seeder
{
    public function run(): void
    {
        $species = [
            [
                'name' => 'Cão',
                'slug' => 'cao',
                'group' => GroupSpecieEnum::MAMIFERO,
                'active' => true,
            ],
            [
                'name' => 'Gato',
                'slug' => 'gato',
                'group' => GroupSpecieEnum::MAMIFERO,
                'active' => true,
            ],
            [
                'name' => 'Coelho',
                'slug' => 'coelho',
                'group' => GroupSpecieEnum::MAMIFERO,
                'active' => true,
            ],
            [
                'name' => 'Porquinho-da-índia',
                'slug' => 'porquinho-da-india',
                'group' => GroupSpecieEnum::MAMIFERO,
                'active' => true,
            ],
            [
                'name' => 'Hamster',
                'slug' => 'hamster',
                'group' => GroupSpecieEnum::MAMIFERO,
                'active' => true,
            ],
            [
                'name' => 'Chinchila',
                'slug' => 'chinchila',
                'group' => GroupSpecieEnum::MAMIFERO,
                'active' => true,
            ],
            [
                'name' => 'Furão',
                'slug' => 'furao',
                'group' => GroupSpecieEnum::MAMIFERO,
                'active' => true,
            ],

            // Aves domésticas
            [
                'name' => 'Papagaio',
                'slug' => 'papagaio',
                'group' => GroupSpecieEnum::PASSARO,
                'active' => true,
            ],
            [
                'name' => 'Calopsita',
                'slug' => 'calopsita',
                'group' => GroupSpecieEnum::PASSARO,
                'active' => true,
            ],
            [
                'name' => 'Periquito',
                'slug' => 'periquito',
                'group' => GroupSpecieEnum::PASSARO,
                'active' => true,
            ],
            [
                'name' => 'Canário',
                'slug' => 'canario',
                'group' => GroupSpecieEnum::PASSARO,
                'active' => true,
            ],
            [
                'name' => 'Cacatua',
                'slug' => 'cacatua',
                'group' => GroupSpecieEnum::PASSARO,
                'active' => true,
            ],

            // Répteis domésticos
            [
                'name' => 'Tartaruga',
                'slug' => 'tartaruga',
                'group' => GroupSpecieEnum::REPTIL,
                'active' => true,
            ],
            [
                'name' => 'Cágado',
                'slug' => 'cagado',
                'group' => GroupSpecieEnum::REPTIL,
                'actived' => true,
            ],
            [
                'name' => 'Iguana',
                'slug' => 'iguana',
                'group' => GroupSpecieEnum::REPTIL,
                'actived' => true,
            ],
            [
                'name' => 'Gecko',
                'slug' => 'gecko',
                'group' => GroupSpecieEnum::REPTIL,
                'actived' => true,
            ],
            [
                'name' => 'Cobra (não venenosa)',
                'slug' => 'cobra-nao-venenosa',
                'group' => GroupSpecieEnum::REPTIL,
                'actived' => true,
            ],

            // Peixes ornamentais
            [
                'name' => 'Peixe',
                'slug' => 'peixe',
                'group' => GroupSpecieEnum::PEIXE,
                'active' => true,
            ],

            // Anfíbios domésticos
            [
                'name' => 'Rã',
                'slug' => 'ra',
                'group' => GroupSpecieEnum::AMFIBIO,
                'active' => true,
            ],
            [
                'name' => 'Sapo',
                'slug' => 'sapo',
                'group' => GroupSpecieEnum::AMFIBIO,
                'active' => true,
            ],
            [
                'name' => 'Axolote',
                'slug' => 'axolote',
                'group' => GroupSpecieEnum::AMFIBIO,
                'active' => true,
            ],
        ];

        $speciesExisting = Specie::pluck('slug')->toArray();
        $speciesToInsert = array_filter($species, function ($specie) use ($speciesExisting) {
            return !in_array($specie['slug'], $speciesExisting, true);
        });
        Specie::insert($speciesToInsert);
    }
}