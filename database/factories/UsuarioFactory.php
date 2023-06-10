<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;


class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            "nombre" => $this->faker->firstName(),
            "email"  => $this->faker->email,
            "isAdmin"  => false,
            "password" => Hash::make("12345678"),
        ];
    }
}
