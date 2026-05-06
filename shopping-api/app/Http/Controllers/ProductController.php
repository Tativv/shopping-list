<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //  Listar produtos
    public function index()
    {
        return Product::all();
    }

    // Criar produto
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'bought' => false
        ]);

        return response()->json($product, 201);
    }

    // Remover produto
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }

    // comprado / no comprado
    public function update($id)
{
    $product = Product::findOrFail($id);

    // 🔥 Alternar entre 0 y 1
    $product->bought = $product->bought == 1 ? 0 : 1;

    $product->save();

    return response()->json($product);
}
}
