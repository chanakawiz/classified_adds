
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classified Ads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<!-- Navigation -->
<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">{{ config('app.name') }}</a>
                <div class="hidden md:flex items-center space-x-4">
                    @foreach(\App\Models\Category::all() as $category)
                        <a href="{{ url('category/'.$category->slug) }}" class="text-gray-600 hover:text-blue-600 text-sm">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" data-theme-toggle aria-label="Toggle theme"
                        class="rounded-full p-2 hover:bg-gray-100 transition text-gray-700">
                    <svg class="h-5 w-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M17.293 13.293A8 8 0 116.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                    </svg>
                    <svg class="h-5 w-5 hidden dark:inline" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-4 7a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM3 9a1 1 0 100 2H2a1 1 0 100-2h1zm15 0a1 1 0 100 2h-1a1 1 0 100-2h1zM4.222 4.222a1 1 0 011.415 0l.708.708a1 1 0 11-1.414 1.414l-.709-.708a1 1 0 010-1.414zM15.656 15.656a1 1 0 011.415 0l.708.708a1 1 0 11-1.414 1.414l-.709-.708a1 1 0 010-1.414zM15.657 4.222a1 1 0 010 1.415l-.708.708a1 1 0 11-1.415-1.414l.709-.709a1 1 0 011.414 0zM4.222 15.657a1 1 0 010 1.415l-.708.708A1 1 0 112.1 16.365l.709-.709a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                <a href="{{ route('ads.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-full transition hidden sm:inline-flex">
                    + Post Ad
                </a>
                <button type="button" data-mobile-nav-toggle
                        class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-controls="mobileNav" aria-expanded="false" aria-label="Open main menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobileNav" class="md:hidden hidden py-2">
            <div class="space-y-1">
                @foreach(\App\Models\Category::all() as $category)
                    <a href="{{ url('category/'.$category->slug) }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
                        {{ $category->name }}
                    </a>
                @endforeach
                <a href="{{ route('ads.create') }}" class="block px-3 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    + Post Ad
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Optional Hero (Home only) -->
@if (request()->is('/'))
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-20 text-center">
        <h1 class="text-4xl font-bold mb-4">Find Everything You Need</h1>
        <p class="text-lg mb-6">Browse ads from multiple categories or post your own</p>
        <form action="{{ url('/search') }}" method="GET" class="max-w-xl mx-auto">
            <div class="flex items-center bg-white rounded-full shadow overflow-hidden">
                <input type="text" name="q" placeholder="Search ads..."
                       class="w-full px-4 py-2 text-gray-700 focus:outline-none" required>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 font-semibold">
                    Search
                </button>
            </div>
        </form>
    </div>
@endif

<!-- Page Content -->
<main class="min-h-[60vh]">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white border-t mt-12 text-center text-sm text-gray-500 py-6">
    &copy; {{ now()->year }} Classified Ads. All rights reserved.
</footer>

</body>
</html>
