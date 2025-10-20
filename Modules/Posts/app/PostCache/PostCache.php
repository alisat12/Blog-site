<?php

namespace Modules\Posts\PostCache;

use App\BaseCache\BaseCache;

class PostCache extends BaseCache
{
    protected static string $key = 'post_cache_';
}