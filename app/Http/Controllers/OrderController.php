<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::with('customer', 'products')->get();
    }

    /**
     * Cria um novo pedido.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Valida os dados do pedido
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Cria o pedido
        $order = Order::create([
            'customer_id' => $request->customer_id,
        ]);

        // Anexa os produtos ao pedido
        $order->products()->attach($request->product_ids);

        // Envia um e-mail de confirmação para o cliente
        Mail::to($order->customer->email)->send(new OrderCreated($order));

        // Retorna a resposta JSON com o pedido criado
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order->load('customer', 'products');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product_ids' => 'array',
            'product_ids.*' => 'exists:products,id',
        ]);

        if ($request->has('product_ids')) {
            $order->products()->sync($request->product_ids);
        }

        return response()->json($order->load('customer', 'products'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(null, 204);
    }
}
