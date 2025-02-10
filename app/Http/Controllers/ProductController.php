<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Cria um novo produto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Valida os dados do produto
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_type_id' => 'required|exists:product_types,id',
        ]);

        // Armazena a foto do produto
        $path = $request->file('photo')->store('products', 'public');

        // Cria o produto
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $path,
            'product_type_id' => $request->product_type_id,
        ]);

        // Retorna a resposta JSON com o produto criado
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'string',
            'price' => 'numeric',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products', 'public');
            $product->photo = $path;
        }

        $product->update($request->only(['name', 'price']));

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
