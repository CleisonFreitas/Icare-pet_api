<?php

namespace Database\Factories\Pet;

use App\Enums\Pets\MedicalTypeEnum;
use App\Models\Pet\MedicalRecord;
use App\Models\Pet\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory(),
            'description' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'medical_care' => $this->faker->word(),
            'medical_care_type' => $this->faker->randomElement(MedicalTypeEnum::cases()),
            'medical_care_details' => $this->faker->sentence(),
            'treated_by' => $this->faker->name(),
            'weight' => $this->faker->randomFloat(2, 0.5, 100.0),
            'body_temperature' => $this->faker->randomFloat(2, 35.0, 42.0),
            'heart_rate' => $this->faker->numberBetween(60, 120),
            'respiratory_rate' => $this->faker->numberBetween(12, 30),
            'main_complaint' => $this->faker->sentence(),
            'next_appointment' => $this->faker->date(),
            'clinical_notes' => $this->faker->paragraph(),
        ];
    }
}
