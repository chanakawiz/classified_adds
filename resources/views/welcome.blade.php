<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classified Ads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-gray-100 via-blue-50 to-indigo-100 font-sans antialiased">

<!-- Navigation -->
<nav class="bg-white/90 backdrop-blur shadow-lg sticky top-0 z-50 transition-all duration-300 mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Site Name -->
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-indigo-700 tracking-tight hover:scale-105 transition-transform duration-200">
                <span class="bg-gradient-to-r from-blue-500 to-indigo-600 bg-clip-text text-transparent">Classified Ads</span>
            </a>
            <div class="flex items-center space-x-2">
                @auth
                    <a href="{{ route('ads.create') }}"
                       class="flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-600 text-white text-base px-6 py-3 rounded-full shadow-xl font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                       style="box-shadow: 0 4px 24px 0 rgba(99,102,241,0.15);">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Post Ad
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-indigo-700 font-semibold px-4 py-2 rounded hover:bg-indigo-50 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="text-indigo-700 font-semibold px-4 py-2 rounded hover:bg-indigo-50 transition">Login</a>
                    <a href="{{ route('register') }}"
                       class="text-white bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 rounded-full font-semibold shadow hover:from-indigo-700 hover:to-blue-700 transition">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 text-white py-24 text-center shadow-lg transition-all duration-300 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-1/4 w-40 h-40 bg-indigo-400 opacity-30 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute bottom-10 right-1/4 w-32 h-32 bg-blue-400 opacity-20 rounded-full blur-2xl animate-pulse"></div>
    </div>
    <div class="relative z-10">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-4 drop-shadow-lg animate-fade-in">
            Find Everything You Need
        </h1>
        <p class="text-xl md:text-2xl mb-8 font-medium opacity-90 animate-fade-in delay-100">
            Browse the most popular categories and discover the latest ads!
        </p>
        <form action="{{ url('/search') }}" method="GET" class="max-w-xl mx-auto animate-fade-in delay-200">
            <div class="flex flex-col sm:flex-row items-center bg-white rounded-full shadow-lg overflow-hidden border-2 border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-400 transition-all duration-200">
                <input type="text" name="q" placeholder="Search ads..."
                       class="w-full px-5 py-3 text-gray-700 focus:outline-none text-lg font-medium" required>
                <button type="submit"
                        class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-600 text-white px-8 py-3 font-bold rounded-full transition-all duration-200 transform hover:scale-105 mt-2 sm:mt-0">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Categories Section (All categories as selectable cards) -->
<main class="max-w-7xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-indigo-700 mb-8 text-center">Browse Categories</h2>
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach($categories as $category)
            <a href="{{ url('category/'.$category->slug) }}"
               class="group block bg-white border border-indigo-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden cursor-pointer hover:border-indigo-400 focus:ring-2 focus:ring-indigo-400">
                <div class="p-8 flex flex-col items-center justify-center">
                    <div class="w-16 h-16 mb-4 bg-indigo-100 rounded-full flex items-center justify-center group-hover:bg-indigo-200 transition">
                        <!-- Optional: category icon or emoji -->
                        <span class="text-3xl text-indigo-600 font-bold">{{ strtoupper(substr($category->name,0,1)) }}</span>
                    </div>
                    <div class="text-xl font-bold text-indigo-700 group-hover:text-indigo-900 transition-colors duration-200 mb-2 text-center">
                        {{ $category->name }}
                    </div>
                    <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full font-semibold text-xs shadow-sm mb-2">
                        {{ $category->ads_count ?? 0 }} ads
                    </span>
                    <span class="text-sm text-gray-500">View ads in {{ $category->name }}</span>
                </div>
            </a>
        @endforeach
    </div>
</main>

<!-- Footer -->
<footer class="bg-white/90 border-t mt-16 text-center text-sm text-gray-500 py-8 shadow-inner">
    <div class="flex justify-center items-center space-x-2">
        <span class="font-semibold text-indigo-600">&copy; {{ now()->year }} Classified Ads.</span>
        <span>All rights reserved.</span>
    </div>
    <div class="mt-2 text-xs text-gray-400">
        Crafted with <span class="text-red-400 animate-pulse">♥</span> using Laravel & Tailwind CSS
    </div>
</footer>

<!-- Simple fade-in animation -->
<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px);}
    to { opacity: 1; transform: translateY(0);}
}
.animate-fade-in {
    animation: fade-in 1s cubic-bezier(.4,0,.2,1) both;
}
.animate-fade-in.delay-100 { animation-delay: .1s; }
.animate-fade-in.delay-200 { animation-delay: .2s; }
</style>

</body>
</html>
