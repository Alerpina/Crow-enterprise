<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Generalsetting;
use App\Services\Bling;
use Illuminate\Console\Command;

class InsertCategoriesBling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bling:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert all categories in Bling!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bling = new Bling(Generalsetting::first()->bling_access_token);
        $bar = $this->output->createProgressBar(Category::count());

        Category::chunk(25, function ($categories) use ($bling, $bar) {
            foreach ($categories as $category) {
                $category->ref_code = $bling->createCategory($category->name);
                $category->save();
                $bar->advance();
            }
        });

        return 0;
    }
}
