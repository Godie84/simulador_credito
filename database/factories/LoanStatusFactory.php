<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LoanStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanStatus>
 */
class LoanStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    // Nombre del modelo asociado con esta fábrica
    protected $model = LoanStatus::class;

    public function definition(): array
    {
        return [
            // Generamos un nombre de estado utilizando Faker
            'name' => $this->faker->randomElement(['Pendiente', 'Aprobado', 'Rechazado']),
        ];
    }
}
