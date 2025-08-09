<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Classified Ads' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">

<!-- Navigation -->
<nav class="bg-white/90 backdrop-blur shadow-lg sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Site Name -->
            <a href="{{ url('/') }}" class="text-2xl font-extrabold text-indigo-700 tracking-tight hover:scale-105 transition-transform duration-200">
                <span class="bg-gradient-to-r from-blue-500 to-indigo-600 bg-clip-text text-transparent">Classified Ads</span>
            </a>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-2">
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

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden pb-4">
            <div class="flex flex-col space-y-2">
                @auth
                    <a href="{{ route('ads.create') }}"
                       class="flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-3 rounded-full font-semibold shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Post Ad
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center text-indigo-700 font-semibold px-4 py-2 rounded hover:bg-indigo-50 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-center text-indigo-700 font-semibold px-4 py-2 rounded hover:bg-indigo-50 transition">Login</a>
                    <a href="{{ route('register') }}" class="text-center text-white bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 rounded-full font-semibold shadow hover:from-indigo-700 hover:to-blue-700 transition">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Page Content -->
<main>
    @yield('content')
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

<!-- Scripts -->
<script>
// Mobile menu toggle
document.getElementById('mobileMenuBtn').addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');
});
</script>
@stack('scripts')
</body>
</html>
