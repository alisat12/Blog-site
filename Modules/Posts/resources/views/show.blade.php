@extends('posts::layouts.master')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
    <!-- Post Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $post->title }}</h1>
        
        <div class="flex items-center justify-between text-sm text-gray-500 mt-2">
            <span><i class="fas fa-calendar-alt mr-1"></i> {{ $post->created_at->format('M d, Y') }}</span>
            <span>
                @if($post->status === 'published')
                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">
                        <i class="fas fa-check-circle mr-1"></i>Published
                    </span>
                @else
                    <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded">
                        <i class="fas fa-edit mr-1"></i>Draft
                    </span>
                @endif
            </span>
        </div>
    </div>

    <!-- Post Image -->
    @if($post->image)
    <div class="mb-6">
        <img src="{{ Storage::url($post->image) }}" 
             alt="{{ $post->title }}"
             class="w-full h-64 object-cover rounded">
    </div>
    @endif

    <!-- Post Content -->
    <div class="prose max-w-none text-gray-700">
        {{ nl2br(e($post->content)) }}
    </div>
    

    <div class="prose max-w-none text-gray-700">
        {{-- @dd($post->category) --}}
        {{ $post->category->name }}
    </div>


    <!-- Back Button -->
    <div class="mt-8">
        <a href="{{ route('posts.index') }}" 
           class="inline-flex items-center text-blue-600 hover:underline">
            <i class="fas fa-arrow-left mr-2"></i>Back to all posts
        </a>
    </div>
</div>
@endsection
