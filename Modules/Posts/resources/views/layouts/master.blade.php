<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Posts Module')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
                    <a href="{{ route('posts.index') }}" class="text-xl font-bold text-gray-800">
                        Posts Module
                    </a>
                </div>
                <div>
                    <a href="{{ route('posts.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>New Post
                    </a>
                    
                    <a href="{{ route('categories.create') }}"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-folder-plus mr-1"></i> Add Category
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8">
        <!-- Alerts -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-green-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <p class="font-semibold">Please fix the following errors:</p>
            </div>
            <ul class="list-disc list-inside ml-8">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12">
        <div class="container mx-auto px-6 py-4 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} Posts Module. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>

</html>
