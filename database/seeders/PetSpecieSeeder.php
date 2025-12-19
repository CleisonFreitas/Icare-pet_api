<?php

namespace Database\Seeders;

use App\Enums\Pets\GroupSpecieEnum;
use App\Enums\Pets\SpecieNameEnum;
use App\Models\Pet\Specie;
use Illuminate\Database\Seeder;

class PetSpecieSeeder extends Seeder
{
    public function run(): void
    {
        $species = [];

        foreach (SpecieNameEnum::cases() as $case) {
            // assign group by specie
            $group = match ($case) {
                SpecieNameEnum::DOG,
                SpecieNameEnum::CAT,
                SpecieNameEnum::RABBIT,
                SpecieNameEnum::GUINEA_PIG,
                SpecieNameEnum::HAMSTER,
                SpecieNameEnum::CHINCHILLA,
                SpecieNameEnum::FERRET => GroupSpecieEnum::MAMIFERO,

                SpecieNameEnum::PARROT,
                SpecieNameEnum::COCKATIEL,
                SpecieNameEnum::BUDGIE,
                SpecieNameEnum::CANARY,
                SpecieNameEnum::COCKATOO => GroupSpecieEnum::PASSARO,

                SpecieNameEnum::TURTLE,
                SpecieNameEnum::CAGADO,
                SpecieNameEnum::IGUANA,
                SpecieNameEnum::GECKO,
                SpecieNameEnum::NON_VENOMOUS_SNAKE => GroupSpecieEnum::REPTIL,

                SpecieNameEnum::FISH => GroupSpecieEnum::PEIXE,

                SpecieNameEnum::FROG,
                SpecieNameEnum::TOAD,
                SpecieNameEnum::AXOLOTL => GroupSpecieEnum::AMFIBIO,

                default => GroupSpecieEnum::MAMIFERO,
            };

            $species[] = [
                'name' => $case->description(),
                'slug' => $case->slug(),
                'group' => $group,
                'active' => true,
            ];
        }

        $speciesExisting = Specie::pluck('slug')->toArray();
        $speciesToInsert = array_filter($species, function ($specie) use ($speciesExisting) {
            return !in_array($specie['slug'], $speciesExisting, true);
        });

        if (!empty($speciesToInsert)) {
            Specie::insert($speciesToInsert);
        }
    }
}