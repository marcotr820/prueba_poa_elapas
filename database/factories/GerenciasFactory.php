<?php

namespace Database\Factories;

use App\Models\Gerencias;
use Illuminate\Database\Eloquent\Factories\Factory;

class GerenciasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gerencias::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nombre_gerencia' => $this->faker->unique()->randomElement(['Gerencia General', 'Gerencia Administrativa', 'Gerencia Comercial', 'Gerencia Tecnica']),
        ];
    }
}
