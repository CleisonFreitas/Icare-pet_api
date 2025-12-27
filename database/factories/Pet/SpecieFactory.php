<?php

namespace Database\Factories\Pet;

use App\Enums\Pets\GroupSpecieEnum;
use App\Models\Pet\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Specie>
 */
class SpecieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'group' => $this->faker->randomElement(GroupSpecieEnum::cases()),
            'active' => $this->faker->boolean(),
        ];
    }
}
