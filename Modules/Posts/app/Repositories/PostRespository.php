<?php

namespace Modules\Posts\Repositories;
use Modules\Posts\Models\Post;
use Modules\Posts\PostCache\PostCache;

class PostRespository extends PostCache
{

    public static function getAllPosts()
    {
        $posts = PostCache::getFromCache('all_posts');
        if(!$posts)
        {
            $posts = Post::all();
            PostCache::addToCache('all_posts', $posts, 120);
        }
        return $posts;
    } 

    public static function getPostById($id)
    {
        $post = PostCache::getFromCache($id);

        if(!$post)
        {
            $post = Post::where('id',$id)->first();
            PostCache::addToCache($id, $post, 120);    
        }

        return $post;
    }

    public static function getAllPaginatedPosts($perPage, $page)
    {
        $key = 'all_posts_'. $page;
        $posts = PostCache::getFromCache($key);
        if(!$posts)
        {
            $posts = Post::paginate($perPage);
            PostCache::addToCache($key, $posts, 120);
        }
        return $posts;
    }
    public function handle() {}
}
