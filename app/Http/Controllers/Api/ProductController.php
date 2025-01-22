<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Jobs\SendProductCreatedNotification;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }
}
