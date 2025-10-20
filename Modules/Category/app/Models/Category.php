<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Database\Factories\CategoryFactory;
use Modules\Posts\Models\Post;

// use Modules\Category\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug'
    ];
    public function post()
    {
        return $this->hasMany(Post::class);
    }

    protected static function newFactory(): CategoryFactory
    {
        // dd('shadfkjdhasfhds');
        return CategoryFactory::new();
    }
}
