<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lista de tipos de produtos a serem inseridos no banco de dados
        $types = [
            'Pastel',
            'Salgado',
            'Suco',
            'Refrigerante',
            'Doce',
            'Bebida',
        ];

        // Insere cada tipo de produto na tabela 'product_types'
        foreach ($types as $type) {
            ProductType::create(['name' => $type]);
        }
    }
}
