<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'photo' => UploadedFile::fake()->image('product.jpg')->store('products', 'public'),
            'product_type_id' => ProductType::factory(), // Cria um tipo de produto associado
        ];
    }
}
