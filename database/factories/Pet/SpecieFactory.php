<?php

namespace Database\Factories\Pet;

use App\Enums\Logs\App\Pets\GroupSpecieEnum;
use App\Models\Pet\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Specie>
 */
class SpecieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
