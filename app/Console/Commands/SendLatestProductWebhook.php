<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendLatestProductWebhook extends Command
{
    /**
     * @var string
     */
    protected $signature = 'products:send-latest';

    /**
     * @var string
     */
    protected $description = 'Send latest product info to webhook';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $product = Product::query()->latest('id')->first();

        if ($product) {
            Http::post(
                config('products.webhook'),
                (new ProductResource($product))->toArray(request())
            );
            return 0;
        }

        return 1;
    }
}
