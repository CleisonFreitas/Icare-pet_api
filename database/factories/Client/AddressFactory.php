<?php

namespace Database\Factories\Client;

use App\Models\Client\Address;
use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'street' => $this->faker->streetAddress(),
            'number' => $this->faker->buildingNumber(),
            'complement' => $this->faker->optional()->word(),
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zip_code' => $this->faker->postcode(),
            'country' => $this->faker->country()
        ];
    }
}
