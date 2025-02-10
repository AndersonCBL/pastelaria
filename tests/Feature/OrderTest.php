<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação de um novo pedido e o envio de e-mail.
     *
     * @return void
     */
    public function test_criar_novo_pedido()
    {
        // Finge o envio de e-mails
        Mail::fake();

        // Cria um cliente e produtos para o teste
        $customer = Customer::factory()->create();
        $productType = ProductType::factory()->create(); // Cria um tipo de produto
        $products = Product::factory()->count(3)->create(['product_type_id' => $productType->id]); // Associa os produtos ao tipo de produto

        // Dados do pedido
        $payload = [
            'customer_id' => $customer->id,
            'product_ids' => $products->pluck('id')->toArray()
        ];

        // Faz a requisição para criar o pedido
        $response = $this->postJson('/api/orders', $payload);

        // Verifica se a resposta foi bem-sucedida
        $response->assertStatus(201)
            ->assertJsonFragment(['customer_id' => $customer->id]);

        $this->assertDatabaseHas('orders', ['customer_id' => $customer->id]);
        $this->assertCount(3, Order::first()->products);

        // Verifica se o e-mail foi enviado para o cliente
        Mail::assertSent(OrderCreated::class, function ($mail) use ($customer) {
            return $mail->hasTo($customer->email);
        });
    }

    public function test_atualizar_pedido()
    {
        // Cria um cliente e produtos para o teste
        $customer = Customer::factory()->create();
        $productType = ProductType::factory()->create(); // Cria um tipo de produto
        $products = Product::factory()->count(3)->create(['product_type_id' => $productType->id]); // Associa os produtos ao tipo de produto

        // Cria um pedido
        $order = Order::create(['customer_id' => $customer->id]);
        $order->products()->attach($products->pluck('id')->toArray());

        // Novos produtos para atualizar o pedido
        $newProducts = Product::factory()->count(2)->create(['product_type_id' => $productType->id]);

        // Dados para atualização do pedido
        $payload = [
            'product_ids' => $newProducts->pluck('id')->toArray()
        ];

        // Faz a requisição para atualizar o pedido
        $response = $this->putJson("/api/orders/{$order->id}", $payload);

        // Verifica se a resposta foi bem sucedida
        $response->assertStatus(200)
            ->assertJsonFragment(['customer_id' => $customer->id]);

        // Verifica se os produtos do pedido foram atualizados
        $this->assertCount(2, $order->fresh()->products);
    }

    public function test_excluir_pedido()
    {
        $order = Order::factory()->create();

        $response = $this->deleteJson("/api/orders/{$order->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

}

