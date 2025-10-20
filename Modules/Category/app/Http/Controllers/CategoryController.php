<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function create()
    {
        return view('category::create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        Category::create($validated);

        return redirect()->back()->with('success', 'Category created successfully.');
    }
}
