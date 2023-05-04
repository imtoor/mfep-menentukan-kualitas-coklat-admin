<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProdukController extends Controller
{
    public function index() {

        $products = Product::latest()->get();

        return new ProductResource(true, 'List Data Produk', $products);
    }
}
