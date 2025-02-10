<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação de um novo produto.
     *
     * @return void
     */
    public function test_criar_novo_produto()
    {
        // Finge o armazenamento de arquivos
        Storage::fake('public');

        // Cria um tipo de produto para o teste
        $productType = ProductType::factory()->create();

        // Dados do produto
        $payload = [
            'name' => 'Pastel de Carne',
            'price' => 10.50,
            'photo' => UploadedFile::fake()->image('pastel.jpg'),
            'product_type_id' => $productType->id
        ];

        // Faz a requisição para criar o produto
        $response = $this->postJson('/api/products', $payload);

        // Verifica se a resposta foi bem-sucedida
        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Pastel de Carne']);

        // Verifica se a foto foi armazenada
        $this->assertDatabaseHas('products', ['name' => 'Pastel de Carne']);

        // Verifica se a foto foi armazenada
        Storage::disk('public')->assertExists('products/' . $payload['photo']->hashName());
    }

    /**
     * Testa a atualização de um produto.
     *
     * @return void
     */
    public function test_atualizar_produto()
    {
        // Finge o armazenamento de arquivos
        Storage::fake('public');

        // Cria um tipo de produto para o teste
        $productType = ProductType::factory()->create();

        // Cria um produto para o teste
        $product = Product::factory()->create();

        // Dados para atualização do produto
        $payload = [
            'name' => 'Pastel de Frango',
            'price' => 11.00,
            'photo' => UploadedFile::fake()->image('pastel_frango.jpg'),
            'product_type_id' => $productType->id
        ];

        // Faz a requisição para atualizar o produto
        $response = $this->putJson("/api/products/{$product->id}", $payload);

        // Verifica se a resposta foi bem-sucedida
        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Pastel de Frango']);

        // Verifica se o produto foi atualizado no banco de dados
        $this->assertDatabaseHas('products', ['name' => 'Pastel de Frango']);

        // Verifica se a nova foto foi armazenada
        Storage::disk('public')->assertExists('products/' . $payload['photo']->hashName());
    }

    /**
     * Testa a exclusão de um produto.
     *
     * @return void
     */
    public function test_excluir_produto()
    {
        // Cria um tipo de produto para o teste
        $productType = ProductType::factory()->create();

        // Cria um produto para o teste
        $product = Product::factory()->create(['product_type_id' => $productType->id]);

        // Faz a requisição para excluir o produto
        $response = $this->deleteJson("/api/products/{$product->id}");

        // Verifica se a resposta foi bem-sucedida
        $response->assertStatus(204);

        // Verifica se o produto foi excluído do banco de dados
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

}

