<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendProductWebhook extends Command
{
    protected $signature = 'products:webhook';
    protected $description = 'Send latest product info to webhook';

    public function handle()
    {
        $product = Product::query()
            ->latest('id')
            ->first();

        if (!$product) {
            $this->info('No products found.');
            return;
        }

        $response = Http::post(config('products.webhook'), [
            'product' => $product->toArray()
        ]);
dump($response->json());
        if ($response->successful()) {
            $this->info('Webhook sent successfully.');
        } else {
            $this->error('Failed to send webhook.');
        }
    }
}
