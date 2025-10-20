<?php
namespace Modules\Category\CategoryCache;

use App\BaseCache\BaseCache;

class CategoryCache extends BaseCache
{
    protected static string $key = 'all_categories';
}
