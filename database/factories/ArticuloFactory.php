<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Articulo;


class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Articulo::class;

    public function definition()
    {
        return [
            "nombre" => $this->faker->firstName(),
            "tipo" => $this->faker->randomElement($array = ['Manta', 'Peluche', 'Pulsera', 'Monedero', 'Bolso', 'Otro']) ,
            "precio" => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 50),
            "stock"  => $this->faker->randomDigitNot(0),
            "imagen" => $this->faker->imageUrl($width = 640, $height = 480),
            "descripcion" => $this->faker->sentence(),
            "puntuacion" => $this->faker->numberBetween($min = 0, $max = 4),
        ];
    }
}
