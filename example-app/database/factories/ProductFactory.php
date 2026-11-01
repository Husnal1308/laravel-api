<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory //untuk sample data di database
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama" => fake()->name(),
            "harga" => fake()->numberBetween(5, 200)*1000,
            "kategori" => fake()->randomElement(['Minuman', 'Makanan', 'Snack']),
            "sku" => fake()->unique()->regexify('[A-Z0-9]{10}'),
        ];
    }
}
