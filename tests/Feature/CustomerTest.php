<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_novo_cliente()
    {
        $payload = [
            'name' => 'João Silva',
            'email' => 'joaodasilva@email.com',
            'phone' => '11999999999',
            'birth_date' => '1990-01-01',
            'address' => 'Rua XPTO, 123',
            'complement' => 'Apto 101',
            'neighborhood' => 'Centro',
            'cep' => '12345-678',
        ];

        $response = $this->postJson('/api/customers', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['email' => 'joaodasilva@email.com']);

        $this->assertDatabaseHas('customers', ['email' => 'joaodasilva@email.com']);
    }
}
