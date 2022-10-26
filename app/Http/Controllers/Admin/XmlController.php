<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Console\Command;

class XmlController extends Controller
{
    public function importProductXml(Command $command)
    {
        $content = File::get(storage_path("app/public/xml/".config('app.xml_product_file')));
        $collection = collect(xml_decode($content)["Item"]);
        $languages = Language::all();

        $progress = $command->output->createProgressBar($collection->count());
        
        $product_translations = [];
        $products = [];

        foreach($collection->chunk(500) as $items) {
            foreach ($items as $item) {
                $brand = Brand::where("name", "LIKE", $item['Marca'])->first();
                if (!$brand) {
                    $brand = new Brand;
                    $brand->name = $item['Marca'];
                    $brand->slug = Str::slug($item['Marca']);
                    $brand->save();
                }

                $category_data = [];
                $subcategory_data = [];
                foreach ($languages as $language) {
                    $product_translation['locale'] = $language->locale;
                    $product_translation['name'] = $item['Nome'];
                    $product_translation["product_id"] = $item['Codigo'];
                    $product_translation["details"] = $item['Descricao'];

                    $category_data[$language->locale] = [
                        "name" => $item['Categoria']
                    ];

                    $subcategory_data[$language->locale] = [
                        "name" => $item['SubCategoria']
                    ];

                    $product_translations[] = $product_translation; 
                }

                $category = Category::where("slug", "LIKE", Str::slug($item['Categoria']))->first();
                if (!$category) {
                    $category_data['slug'] = Str::slug($item['Categoria']);
                    $category = Category::create($category_data);
                }

                $subcategory = Subcategory::where("slug", "LIKE", Str::slug($item['SubCategoria']))->first();
                if (!$subcategory) {
                    $subcategory_data['slug'] = Str::slug($item['SubCategoria']);
                    $subcategory_data['category_id'] = $category->id;
                    $subcategory = Subcategory::create($subcategory_data);
                }

                $product = new Product;
                $product->id = $item['Codigo'];
                $product->stores()->sync([1]);

                $product = [];
                $product['id'] = $item['Codigo'];
                $product['external_name'] = $item['Nome'];
                $product['slug'] = Str::slug($item['Nome']);
                $product['price'] = $item['Valor'];
                $product['stock'] = $item['Estoque'];
                $product['category_id'] = $category->id;
                $product['subcategory_id'] = $subcategory->id;
                $product['brand_id'] = $brand->id;

                $products[] = $product;

                $progress->advance();
            }
        }

        $command->info("\nSalvando produtos");
        Product::upsert($products, ["id"]);

        $command->info("Salvando traduções");
        ProductTranslation::upsert($product_translations, ["id"]);

        $progress->finish();
        $command->info("Produtos importados com sucesso");
    }
}
