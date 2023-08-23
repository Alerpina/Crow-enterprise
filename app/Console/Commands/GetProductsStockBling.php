<?php

namespace App\Console\Commands;

use App\Models\Generalsetting;
use App\Models\Product;
use App\Services\Bling;
use Illuminate\Console\Command;

class GetProductsStockBling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bling:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the stock of products getting the value from Bling!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bling = new Bling(Generalsetting::first()->bling_access_token);
        if (!$bling->access_token) {
            $this->output->write('Access Token não esta definido', true);
            return 1;
        }

        $bar = $this->output->createProgressBar(Product::count());

        Product::chunk(50, function ($products) use ($bling, $bar) {
            foreach ($bling->getStocks($products->pluck('ref_code')->all()) as $stock) {
                $product = $products->where('ref_code', $stock['produto']['id'])->first();

                if (!$product) {
                    continue;
                }

                $product->stock = ceil($stock['saldoFisicoTotal']);
                $product->save();
            }
            $bar->advance(50);
        });

        $this->output->newLine();

        return 0;
    }
}
