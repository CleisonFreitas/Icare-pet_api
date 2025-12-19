<?php

namespace Database\Factories\Pet;

use App\Models\Pet\Examination;
use App\Models\Pet\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Examination>
 */
class ExaminationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory()->lazy(),
            'examination_date' => $this->faker->date(),
            'exame_type' => $this->faker->word(),
            'diagnosis' => $this->faker->sentence(),
            'required_date' => $this->faker->date(),
            'result_date' => $this->faker->date(),
            'performed_by' => User::factory()->lazy(),
            'file_result' => $this->faker->word() . '.pdf',
            'notes' => $this->faker->paragraph(),
        ];
    }
}
