<?php

namespace Database\Factories;

use App\Models\Trabajadores;
use App\Models\Unidades;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrabajadoresFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trabajadores::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'documento' => rand(100000, 999999),
            'nombre' => $this->faker->name(),
            'cargo' => $this->faker->lastName(),
            'unidad_id' => Unidades::all()->random()->id
        ];
    }
}
