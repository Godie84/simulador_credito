<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\LoanStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanRequest>
 */
class LoanRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(), // Relaciona el LoanRequest con un Customer aleatorio
            'requested_amount' => $this->faker->randomFloat(2, 100000, 10000000), // Monto solicitado
            'number_of_installments' => $this->faker->numberBetween(2, 24), // Número de cuotas (de 2 a 24)
            'loan_status_id' => LoanStatus::factory(), // Relaciona el LoanRequest con un LoanStatus aleatorio
        ];
    }
}
