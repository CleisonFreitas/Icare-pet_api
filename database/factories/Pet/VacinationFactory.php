<?php

namespace Database\Factories\Pet;

use App\Models\Pet\Pet;
use App\Models\Pet\Vacination;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vacination>
 */
class VacinationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory()->lazy(),
            'vaccine_name' => $this->faker->word,
            'date_administered' => $this->faker->date(),
            'next_due_date' => $this->faker->date(),
            'performed_by' => User::factory()->lazy(),
            'notes' => $this->faker->sentence,
            'lote' => $this->faker->word,
            'manufacturer' => $this->faker->company,
            'dosage' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
