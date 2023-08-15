<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Generalsetting;
use App\Services\Bling;

class CategoryObserver
{
    private Bling $bling;

    public function __construct() {
        $this->bling = new Bling(Generalsetting::first()->bling_access_token);
    }

    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        if ($this->bling->access_token) {
            $category->ref_code = $this->bling->createCategory($category->name);
        }
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        if ($this->bling->access_token && $category->ref_code) {
            $this->bling->updateCategory($category->name, $category->ref_code);
        }
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        if ($this->bling->access_token && $category->ref_code) {
            $this->bling->deleteCategory($category->ref_code);
        }
    }
}
