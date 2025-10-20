<?php

namespace Modules\Posts\Observers;

use Modules\Posts\Models\Post;
use Modules\Posts\PostCache\PostCache;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void {
        PostCache::deleteFromCache('all_posts');
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void 
    {
        PostCache::deleteFromCache($post->id);
        PostCache::deleteFromCache('all_posts');
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void 
    {
        PostCache::deleteFromCache($post->id);
        PostCache::deleteFromCache('all_posts');
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void {}

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void {}


    // public function retrived(Post $post)
    // {
    //     $category = CategoryRespository::getCategoryById($post->category->id);
    //     $post->category = $category;
    // }
}
