<?php

namespace App\Http\Controllers;

use App\Events\ProductUpdated;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function fetchProducts()
    {
        $response = Http::get('https://fakestoreapi.com/products');
        $products = $response->json();

        foreach ($products as $productData) {
            $product = Product::updateOrCreate(
                ['name' => $productData['title']],
                [
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                ]
            );

            // Broadcast the event
            event(new ProductUpdated($product));
        }

        return redirect()->route('products.index');
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}
