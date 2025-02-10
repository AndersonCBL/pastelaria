<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Lista todos os tipos de produtos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $productTypes = ProductType::all();
        return response()->json($productTypes);
    }
}
