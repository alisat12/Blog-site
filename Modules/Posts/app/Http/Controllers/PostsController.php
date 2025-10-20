<?php

namespace Modules\Posts\Http\Controllers;

use App\BaseCache\BaseCache;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Posts\Models\Post;
use Modules\Posts\Http\Requests\StorePostRequest;
use Modules\Posts\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Modules\Category\Repositories\CategoryRespository;
use Modules\Posts\Repositories\PostRespository;

class PostsController extends Controller
{
    /**
     * Display a listing of posts
     */
    
    public function index()
    {
        $page = request()->get('page', 1);
        $posts = PostRespository::getAllPaginatedPosts(50, $page);
        $categories = CategoryRespository::getAllCategory();
        foreach($posts as $post)
        {
            $category = $categories->firstWhere('id', $post->category_id);
            $post->category = $category;
        }
        return view('posts::index', compact('posts'));
    }

    /**
     * Show the form for creating a new post
     */
    public function create()
    {
        $categories = CategoryRespository::getAllCategory();
        return view('posts::create', compact('categories'));
    }

    /**
     * Store a newly created post
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated([]);
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
        Post::create($data);
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified post
     */
    public function show($id)
    {
        $post = PostRespository::getPostById($id);
        $category = CategoryRespository::getCategoryById($post->category_id);
        $post->category = $category; 
        return view('posts::show', compact('post'));
        
    }

    /**
     * Show the form for editing the specified post
     */
    public function edit(Post $post)
    {
        $categories = CategoryRespository::getAllCategory();
        return view('posts::edit', compact('post','categories'));
    }

    /**
     * Update the specified post
     */
    public function update(UpdatePostRequest $request, Post $post)
    {   
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
        $post->update($data);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}