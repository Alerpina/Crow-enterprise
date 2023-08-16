<?php

namespace App\Console\Commands;

use App\Models\Generalsetting;
use App\Models\Product;
use App\Services\Bling;
use App\Services\Bling\DTOs\ProductDTO;
use App\Services\Bling\DTOs\StockDTO;
use Illuminate\Console\Command;

class InsertProductsBling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bling:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert all products in Bling!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bling = new Bling(Generalsetting::first()->bling_access_token);
        $bar = $this->output->createProgressBar(Product::count());
        $warehouses = $bling->getWarehouses();

        Product::chunk(25, function ($products) use ($bling, $bar, $warehouses) {
            foreach ($products as $product) {
                $product->ref_code = $bling->createProduct(new ProductDTO(
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
                $product->save();

                if (isset($warehouses['data'][0]['id'])) {
                    $bling->createStock(new StockDTO(
                        $product->ref_code,
                        $warehouses['data'][0]['id'],
                        $product->stock
                    ));
                }

                $bar->advance();
            }
        });

        return 0;
    }
}
