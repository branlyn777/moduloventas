<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'cedula' => 7894577,
            'celular' => $this->faker->phoneNumber,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'fecha_nacim' => "1985-11-04",
            'razon_social' => "Ninguna",
            'nit' => $this->faker->randomElement([8995452,8569452,8991242,8995452,7895452,1275452,8654652]),
            'procedencia_cliente_id' => $this->faker->randomElement([1,2,3]),
        ];
    }
}
