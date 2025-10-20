@extends('posts::layouts.master')

@section('title', 'All Posts')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">All Posts</h1>
        {{-- <p class="text-gray-600">Total: {{ $posts->total() }} posts</p> --}}
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if ($posts->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sr# 
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ ($posts->firstItem() ?? 0) + $loop->index }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($post->image)
                                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                                        class="w-16 h-16 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($post->content, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $post->category->name ?? 'Uncategorized' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($post->status === 'published')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Published
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-edit mr-1"></i>Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post->created_at->format('Y:m:d')}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-900"
                                        title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('posts.edit', $post) }}" class="text-green-600 hover:text-green-900"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No posts yet</h3>
                <p class="text-gray-500 mb-4">Get started by creating your first post.</p>
                <a href="{{ route('posts.create') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Create Post
                </a>
            </div>
        @endif
    </div>
@endsection
