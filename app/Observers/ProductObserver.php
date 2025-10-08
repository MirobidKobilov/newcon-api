<?php

namespace App\Observers;

use App\Events\ProductActionEvent;
use App\Models\ActionType;
use App\Product\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        event(new ProductActionEvent($product, ActionType::PRODUCT_CREATED));
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        event(new ProductActionEvent($product, ActionType::PRODUCT_UPDATED));
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        event(new ProductActionEvent($product, ActionType::PRODUCT_DELETED));
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        event(new ProductActionEvent($product, ActionType::PRODUCT_RESTORED));
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        event(new ProductActionEvent($product, ActionType::PRODUCT_FORCE_DELETED));
    }
}
