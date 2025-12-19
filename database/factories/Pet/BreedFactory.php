<?php

namespace Database\Factories\Pet;

use App\Models\Pet\Breed;
use App\Models\Pet\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Breed>
 */
class BreedFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->name;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'specie_id' => Specie::factory()->lazy(),
            'active' => $this->faker->boolean,
        ];
    }
}
