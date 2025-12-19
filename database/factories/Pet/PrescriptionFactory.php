<?php

namespace Database\Factories\Pet;

use App\Models\Pet\Pet;
use App\Models\Pet\Prescription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prescription>
 */
class PrescriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory()->lazy(),
            'start_date' => $this->faker->date(),
            'medication' => $this->faker->word(),
            'dosage' => $this->faker->randomFloat(2, 0, 100),
            'duration' => $this->faker->word(),
            'frequency' => $this->faker->word(),
            'refills' => $this->faker->randomNumber(2),
            'prescribed_by' => User::factory()->lazy(),
            'via_admin' => $this->faker->word()
        ];
    }
}
