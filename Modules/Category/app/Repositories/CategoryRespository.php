<?php

namespace Modules\Category\Repositories;

use Modules\Category\CategoryCache\CategoryCache;
use Modules\Category\Models\Category;

class CategoryRespository
{

    public static function getAllCategory()
    {
        $categories = CategoryCache::getFromCache('all_categories');
        if(!$categories)
        {
            $categories = Category::all();
            CategoryCache::addToCache('all_categories', $categories, 120);
        }
        return $categories;
    }


    public static function getCategoryById($id)
    {
        $category = CategoryCache::getFromCache($id);
        if(!$category)
        {
            $category = Category::where('id', $id)->first();
            // $category = Category::find($id);
            CategoryCache::addToCache($id, $category, 120);
        }
        return $category;
    }



    public function handle() {}
}
