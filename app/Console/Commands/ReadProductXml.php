<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ReadProductXml extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read XML file and import products';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Importando produtos");

        $content = File::get(storage_path("app/public/xml/Produtos.xml"));
        $collection = collect(xml_decode($content)["Item"]);

        $progress = $this->output->createProgressBar($collection->count());

        foreach($collection->chunk(500) as $items) {
            foreach ($items as $item) {
                $category = Category::where("slug", "LIKE", Str::slug($item['Categoria']))->first();
                if (!$category) {
                    $category = new Category;
                    $category->name = $item['Categoria'];
                    $category->slug = Str::slug($item['Categoria']);
                    $category->save();
                }

                $subcategory = Subcategory::where("slug", "LIKE", Str::slug($item['SubCategoria']))->first();
                if (!$subcategory) {
                    $subcategory = new Subcategory;
                    $subcategory->name = $item['SubCategoria'];
                    $subcategory->slug = Str::slug($item['SubCategoria']);
                    $subcategory->category_id = $category->id;
                    $subcategory->save();
                }

                $brand = Brand::where("name", "LIKE", $item['Marca'])->first();
                if (!$brand) {
                    $brand = new Brand;
                    $brand->name = $item['Marca'];
                    $brand->slug = Str::slug($item['Marca']);
                    $brand->save();
                }

                $product = Product::find($item['Codigo']);
                if (!$product) {
                    $product = new Product;
                }

                $product->id = $item['Codigo'];
                $product->name = $item['Nome'];
                $product->slug = Str::slug($item['Nome']);
                $product->details = $item['Descricao'];
                $product->price = $item['Valor'];
                $product->stock = $item['Estoque'];
                $product->category_id = $category->id;
                $product->subcategory_id = $subcategory->id;
                $product->brand_id = $brand->id;
                $product->save();
                $product->stores()->sync([1]);
            }

            $progress->advance();
        }

        $progress->finish();

        return 0;
    }
}
