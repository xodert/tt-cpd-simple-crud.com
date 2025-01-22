<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::query()->paginate(10);

        return new JsonResponse(
            ProductResource::collection($products)
        );
    }
}
