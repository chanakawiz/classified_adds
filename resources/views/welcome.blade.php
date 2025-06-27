{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <title>Classified Ads</title>--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    @vite('resources/css/app.css')--}}
{{--</head>--}}
{{--<body class="bg-gray-100 font-sans antialiased">--}}

{{--<!-- Navigation -->--}}
{{--<nav class="bg-white shadow">--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between h-16">--}}
{{--            <div class="flex items-center space-x-4">--}}
{{--                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900">Classified Ads</a>--}}
{{--                @foreach($categories as $category)--}}
{{--                    <a href="{{ url('category/'.$category->slug) }}" class="text-gray-600 hover:text-blue-500">--}}
{{--                        {{ $category->name }}--}}
{{--                    </a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <div class="flex items-center">--}}
{{--                <a href="{{ route('ads.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">--}}
{{--                    Post an Ad--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<!-- Hero Section -->--}}
{{--<div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-20 text-center">--}}
{{--    <h1 class="text-4xl font-bold mb-4">Find Everything You Need</h1>--}}
{{--    <p class="text-lg mb-6">Browse ads from multiple categories or post your own</p>--}}

{{--    <!-- Search Bar -->--}}
{{--    <form action="{{ url('/search') }}" method="GET" class="max-w-xl mx-auto">--}}
{{--        <div class="flex items-center bg-white rounded-full shadow overflow-hidden">--}}
{{--            <input type="text" name="q" placeholder="Search ads..." class="w-full px-4 py-2 text-gray-700 focus:outline-none" required>--}}
{{--            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 font-semibold">--}}
{{--                Search--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</div>--}}

{{--<!-- Footer -->--}}
{{--<footer class="mt-12 text-center text-gray-600 py-6">--}}
{{--    &copy; {{ now()->year }} Classified Ads. All rights reserved.--}}
{{--</footer>--}}

{{--</body>--}}
{{--</html>--}}


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classified Ads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">

<!-- Navigation -->
<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">Classified Ads</a>
                @foreach(\App\Models\Category::all() as $category)
                    <a href="{{ url('category/'.$category->slug) }}" class="text-gray-600 hover:text-blue-600 text-sm">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            <div>
                <a href="{{ route('ads.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-full transition">
                    + Post Ad
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Optional Hero Section (Only show on Home) -->
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

<!-- Main Content -->
<main class="min-h-[60vh]">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white border-t mt-12 text-center text-sm text-gray-500 py-6">
    &copy; {{ now()->year }} Classified Ads. All rights reserved.
</footer>

</body>
</html>
