<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            'categoria' => $this->faker->randomElement(['Electrónica', 'Hogar', 'Ropa', 'Libros']),
            'stock' => $this->faker->numberBetween(1, 100),
            'detalle' => $this->faker->sentence(10),
        ];
    }
}
