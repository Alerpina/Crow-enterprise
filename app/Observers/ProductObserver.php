<?php

namespace App\Observers;

use App\Models\Generalsetting;
use App\Models\Product;
use App\Services\Bling;
use App\Services\Bling\DTOs\ProductDTO;
use App\Services\Bling\DTOs\StockDTO;
use App\Services\Bling\Enums\Status;

class ProductObserver
{
    private Bling $bling;

    public function __construct() {
        $this->bling = new Bling(Generalsetting::first()->bling_access_token);
    }

    private function syncStock(Product $product)
    {
        $warehouses = $this->bling->getWarehouses();

        if (isset($warehouses['data'][0]['id'])) {
            $this->bling->createStock(new StockDTO(
                $product->ref_code,
                $warehouses['data'][0]['id'],
                $product->stock
            ));
        }
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

            $this->syncStock($product);
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

            $this->syncStock($product);
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
