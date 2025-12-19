<?php

namespace Database\Factories\Client;

use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'password' => $this->faker->password(),
            'birthdate' => $this->faker->date(),
            'active' => $this->faker->boolean(),
        ];
    }
}
