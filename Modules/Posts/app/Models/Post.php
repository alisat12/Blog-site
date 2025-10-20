<?php

namespace Modules\Posts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Models\Category;
use Modules\Category\Repositories\CategoryRespository;
use Modules\Posts\Database\Factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'image',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCategoryAttribute()
{
    // Only load if not already set
    if (!array_key_exists('category', $this->attributes)) {
        return CategoryRespository::getCategoryById($this->category_id);
    }

    return $this->attributes['category'];
}


    //scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}
