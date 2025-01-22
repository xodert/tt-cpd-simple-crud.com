<?php

namespace App\Observers;

use App\Models\Product;
use App\Jobs\SendProductCreatedNotification;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        SendProductCreatedNotification::dispatch($product);
    }
}
