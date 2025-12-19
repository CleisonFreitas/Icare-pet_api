<?php

namespace Database\Seeders;

use App\Enums\Pets\SpecieNameEnum;
use App\Models\Pet\Specie;
use Illuminate\Database\Seeder;
use App\Models\Pet\Breed;

class PetBreedsSeeder extends Seeder
{
    public function run(): void
    {
        $breeds = [];

        // Define main breeds per specie slug
        $mapping = [
            // dogs
            SpecieNameEnum::DOG->slug() => [
                ['name' => 'Labrador Retriever', 'slug' => 'labrador-retriever'],
                ['name' => 'Poodle', 'slug' => 'poodle'],
                ['name' => 'Pastor Alemão', 'slug' => 'pastor-alemao'],
                ['name' => 'Beagle', 'slug' => 'beagle'],
                ['name' => 'Bulldog', 'slug' => 'bulldog'],
            ],
            // cats
            SpecieNameEnum::CAT->slug() => [
                ['name' => 'SRD (Sem Raça Definida)', 'slug' => 'srd'],
                ['name' => 'Persa', 'slug' => 'persa'],
                ['name' => 'Siamês', 'slug' => 'siames'],
                ['name' => 'Ragdoll', 'slug' => 'ragdoll'],
                ['name' => 'Maine Coon', 'slug' => 'maine-coon'],
            ],
            // rabbits / small mammals
            SpecieNameEnum::RABBIT->slug() => [
                ['name' => 'Mini Lop', 'slug' => 'mini-lop'],
                ['name' => 'Rex', 'slug' => 'rex'],
            ],
            SpecieNameEnum::GUINEA_PIG->slug() => [
                ['name' => 'Abyssinian', 'slug' => 'abyssinian'],
                ['name' => 'Peruvian', 'slug' => 'peruvian'],
            ],
            SpecieNameEnum::HAMSTER->slug() => [
                ['name' => 'Hamster Anão Russo', 'slug' => 'anao-russo'],
                ['name' => 'Hamster Sírio', 'slug' => 'sirio'],
            ],
            // birds
            SpecieNameEnum::PARROT->slug() => [
                ['name' => 'Amazona', 'slug' => 'amazona'],
                ['name' => 'Arara', 'slug' => 'arara'],
            ],
            SpecieNameEnum::COCKATIEL->slug() => [
                ['name' => 'Calopsita Comum', 'slug' => 'calopsita-comum'],
            ],
            // reptiles
            SpecieNameEnum::TURTLE->slug() => [
                ['name' => 'Tartaruga Brasileira', 'slug' => 'tartaruga-brasileira'],
            ],
            // fish (generic)
            SpecieNameEnum::FISH->slug() => [
                ['name' => 'Peixe Dourado', 'slug' => 'peixe-dourado'],
                ['name' => 'Tetra', 'slug' => 'tetra'],
            ],
        ];

        $species = Specie::all();
        // Build breeds array by resolving specie ids
        foreach ($mapping as $specieSlug => $items) {
            $specie = $species->firstWhere('slug', $specieSlug);
            if (!$specie) {
                continue;
            }

            foreach ($items as $item) {
                $breeds[] = [
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'specie_id' => $specie->id,
                    'active' => true,
                ];
            }
        }

        // Avoid duplicates by slug
        $existing = Breed::pluck('slug')->toArray();
        $toInsert = array_filter($breeds, function ($b) use ($existing) {
            return ! in_array($b['slug'], $existing, true);
        });

        if (!empty($toInsert)) {
            Breed::insert($toInsert);
        }
    }
}