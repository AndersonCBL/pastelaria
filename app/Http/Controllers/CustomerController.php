<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'complement' => 'nullable|string',
            'neighborhood' => 'required|string',
            'cep' => 'required|string',
        ]);

        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'email' => 'email|unique:customers,email,' . $customer->id,
        ]);

        $customer->update($request->all());

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }
}
