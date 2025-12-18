<?php

namespace Database\Factories\Pet;

use App\Models\Client\Client;
use App\Models\Pet\Pet;
use App\Models\Pet\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'client_id' => Client::factory()->lazy(),
            'specie_id' => Specie::factory()->lazy(),
            'breed' => $this->faker->word(),
            'birth_date' => $this->faker->date(),
            'color' => $this->faker->colorName(),
            'weight' => $this->faker->randomFloat(2, 0.5, 100.0),
            'size' => $this->faker->randomElement([Pet::SMALL, Pet::MEDIUM, Pet::LARGE]),
            'microchipped' => $this->faker->boolean(),
            'microchip_number' => $this->faker->unique()->numerify('##########'),
        ];
    }
}
