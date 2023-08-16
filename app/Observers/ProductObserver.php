<?php

namespace App\Observers;

use App\Models\Generalsetting;
use App\Models\Product;
use App\Services\Bling;
use App\Services\Bling\DTOs\ProductDTO;
use App\Services\Bling\Enums\Status;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    private Bling $bling;

    public function __construct() {
        $this->bling = new Bling(Generalsetting::first()->bling_access_token);
    }

    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        if ($this->bling->access_token) {
            $product->ref_code = $this->bling->createProduct(new ProductDTO(
                null,
                $product->name,
                $product->price,
                $product->sku,
                $product->details,
                $product->weight,
                $product->brand->name,
                $product->category->ref_code,
                $product->width,
                $product->height,
                $product->length,
                $product->image,
            ));
        }
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        if ($this->bling->access_token && $product->ref_code) {
            $this->bling->updateProduct(new ProductDTO(
                null,
                $product->name,
                $product->price,
                $product->sku,
                $product->details,
                $product->weight,
                $product->brand->name,
                $product->category->ref_code,
                $product->width,
                $product->height,
                $product->length,
                $product->image,
            ), intval($product->ref_code));
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        if ($this->bling->access_token && $product->ref_code) {
            $this->bling->changeProductStatus($product->ref_code, Status::Deleted);

            $this->bling->deleteProduct(intval($product->ref_code));
        }
    }
}
