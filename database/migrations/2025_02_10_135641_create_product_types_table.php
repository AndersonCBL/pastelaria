<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cria a tabela `product_types` com colunas 'id' e 'name'
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Adiciona a coluna 'product_type_id' na tabela 'products' como chave estrangeira
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('product_type_id')->constrained('product_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove a coluna 'product_type_id' da tabela 'products'
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_type_id']);
            $table->dropColumn('product_type_id');
        });

        // Remove a tabela 'product_types'
        Schema::dropIfExists('product_types');
    }
};
