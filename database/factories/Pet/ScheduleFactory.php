<?php

namespace Database\Factories\Pet;

use App\Enums\Pets\MedicalTypeEnum;
use App\Enums\Pets\StatusServiceEnum;
use App\Models\Client\Client;
use App\Models\Pet\Pet;
use App\Models\Pet\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Schedule>
 */
class ScheduleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory()->lazy(),
            'pet_id' => Pet::factory()->lazy(),
            'scheduled_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'service_type' => $this->faker->randomElement(MedicalTypeEnum::cases()),
            'status' => $this->faker->randomElement(StatusServiceEnum::cases()),
        ];
    }
}
