<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DocumentType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_type_id' => DocumentType::factory(),  // Si hay una relación con DocumentType
            'document_number' => $this->faker->unique()->numerify('##########'),  // Número de documento único
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['M', 'F', 'O']),
            'birth_date' => $this->faker->date('Y-m-d', '2000-01-01'),  // Fecha de nacimiento
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
