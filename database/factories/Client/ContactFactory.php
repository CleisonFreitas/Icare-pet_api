<?php

namespace Database\Factories\Client;

use App\Enums\Client\ContactTypeEnum;
use App\Models\Client\Client;
use App\Models\Client\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(ContactTypeEnum::values()),
            'value' => $this->faker->email,
            'client_id' => Client::factory()->lazy(),
        ];
    }
}
