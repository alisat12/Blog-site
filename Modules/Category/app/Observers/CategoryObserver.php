<?php

namespace Modules\Category\Observers;

use Modules\Category\CategoryCache\CategoryCache;
use Modules\Category\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void 
    {
        CategoryCache::deleteFromCache('all_categories');
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void 
    {
        CategoryCache::deleteFromCache($category->id);
        CategoryCache::deleteFromCache('all_categories');
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void 
    {
        CategoryCache::deleteFromCache($category->id);
        CategoryCache::deleteFromCache('all_categories');
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void {}

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void {}
}
