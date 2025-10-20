@extends('posts::layouts.master')

@section('title', 'Edit Post')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Edit Post</h1>
            <p class="text-gray-600 mt-2">Update the post details</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="Enter post title" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" id="content" rows="10"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                        placeholder="Write your post content here...">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Image
                    </label>
                    <div x-data="{
                        imageUrl: '{{ $post->image ? Storage::url($post->image) : null }}',
                        handleFileChange(event) {
                            const file = event.target.files[0];
                            if (file) {
                                this.imageUrl = URL.createObjectURL(file);
                            }
                        },
                        removeImage() {
                            this.imageUrl = null;
                            document.getElementById('image').value = '';
                        }
                    }">
                        <!-- Current Image -->
                        <div x-show="imageUrl" class="mb-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Current Image:</p>
                            <div class="relative inline-block">
                                <img :src="imageUrl" alt="Post Image"
                                    class="w-full max-w-md h-64 object-cover rounded-lg border">
                                <button type="button" @click="removeImage"
                                    class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white p-2 rounded-full">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <input type="file" name="image" id="image" accept="image/*" @change="handleFileChange"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Max size: 2MB | Formats: JPEG, PNG, JPG, GIF</p>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                            Published</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('posts.index') }}"
                            class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                            <i class="fas fa-save mr-2"></i>Update Post
                        </button>
                    </div>
                </div>
            </form>
            <div class="flex items-center justify-between">
                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                        <i class="fas fa-trash mr-2"></i>Delete Post
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
