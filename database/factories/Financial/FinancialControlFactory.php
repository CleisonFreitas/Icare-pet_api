<?php

namespace Database\Factories\Financial;

use App\Enums\Financial\PaymentMethodEnum;
use App\Enums\Financial\StatusPaymentEnum;
use App\Enums\Financial\TransactionTypeEnum;
use App\Models\Client\Client;
use App\Models\Financial\FinancialControl;
use App\Models\Pet\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FinancialControl>
 */
class FinancialControlFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory()->lazy(),
            'pet_id' => Pet::factory()->lazy(),
            'transaction_type' => $this->faker->randomElement(TransactionTypeEnum::cases()),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'date' => $this->faker->date(),
            'description' => $this->faker->sentence(),
            'category' => $this->faker->word(),
            'payment_method' => $this->faker->randomElement(PaymentMethodEnum::cases()),
            'status' => $this->faker->randomElement(StatusPaymentEnum::cases()),
        ];
    }
}
