<?php
namespace App\BaseCache;

use Illuminate\Support\Facades\Cache;

abstract class BaseCache
{

    protected static string $key;

    public static function makekey($id)
    {
        return static::$key.$id;
    }

    public static function addToCache($id, $data, $ttl=120)
    {
        Cache::put(static::makekey($id), $data, $ttl);
    }

    public static function getFromCache($id)
    {
        return Cache::get(static::makekey($id));
    }
    
    public static function deleteFromCache($id)
    { 
        $key = static::makekey($id);
        Cache::forget($key);   
    }
    
}
