<?php

namespace App\Helpers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Subcategory;
use App\Models\SubcategoryTranslation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class XmlHelper
{
    public static function importProductXml(Command $command, $file_name)
    {
        $file_path = storage_path("app/public/xml/" . $file_name);
        if (!File::exists($file_path)) {
            $command->info("Arquivo não encontrado");
            return 1;
        }

        $content = File::get($file_path);
        try {
            $collection = collect(xml_decode($content)["Item"]);
        } catch (\Exception $e) {
            $command->info("Erro ao ler aquivo");
            Log::error($e->getMessage());
            return 1;
        }

        $command->info("Importando produtos");

        DB::transaction(function () use ($collection, $command) {
            $languages = Language::all();

            $progress = $command->output->createProgressBar($collection->count());

            $product_translations = [];
            $products = [];

            $category_translations = [];
            $subcategory_translations = [];

            foreach ($collection->chunk(500) as $items) {
                foreach ($items as $item) {
                    $brand = Brand::where("name", "LIKE", $item['Marca'])->first();
                    if (!$brand) {
                        $brand = new Brand;
                        $brand->name = $item['Marca'];
                        $brand->slug = Str::slug($item['Marca']);
                        $brand->save();
                    }

                    $category = Category::where("slug", "LIKE", Str::slug($item['Categoria']))->first();
                    if (!$category) {
                        $category = Category::create([
                            "slug" => Str::slug($item['Categoria'])
                        ]);
                    }

                    $subcategory = Subcategory::where("slug", "LIKE", Str::slug($item['SubCategoria']))->first();
                    if (!$subcategory) {
                        $subcategory = Subcategory::create([
                            'slug' => Str::slug($item['SubCategoria']),
                            'category_id' => $category->id
                        ]);
                    }

                    foreach ($languages as $language) {
                        $product_translation['locale'] = $language->locale;
                        $product_translation['name'] = $item['Nome'];
                        $product_translation["product_id"] = $item['Codigo'];
                        $product_translation["details"] = $item['Descricao'];

                        $category_translation["locale"] = $language->locale;
                        $category_translation["name"] = $item['Categoria'];
                        $category_translation["category_id"] = $category->id;

                        $subcategory_translation["locale"] = $language->locale;
                        $subcategory_translation["name"] = $item['SubCategoria'];
                        $subcategory_translation["subcategory_id"] = $subcategory->id;

                        $product_translations[] = $product_translation;
                        $category_translations[] = $category_translation;
                        $subcategory_translations[] = $subcategory_translation;
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
            ProductTranslation::upsert($product_translations, ['id']);
            CategoryTranslation::upsert($category_translations, ['id']);
            SubcategoryTranslation::upsert($subcategory_translations, ['id']);

            $progress->finish();
            $command->info("Produtos importados com sucesso");
        });
    }
}
