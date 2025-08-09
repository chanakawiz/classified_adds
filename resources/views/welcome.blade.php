<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classified Ads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 via-blue-50 to-indigo-100 font-sans antialiased">

<!-- Navigation -->
<nav class="bg-white/90 backdrop-blur shadow-lg sticky top-0 z-50 transition-all duration-300 mb-4 sm:mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 sm:h-16 items-center">
            <!-- Site Name -->
            <a href="{{ url('/') }}" class="text-xl sm:text-2xl font-extrabold text-indigo-700 tracking-tight hover:scale-105 transition-transform duration-200">
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
                       class="flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-600 text-white text-sm sm:text-base px-4 sm:px-6 py-2 sm:py-3 rounded-full shadow-xl font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                       style="box-shadow: 0 4px 24px 0 rgba(99,102,241,0.15);">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 text-white py-12 sm:py-16 lg:py-24 text-center shadow-lg transition-all duration-300 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-1/4 w-20 sm:w-40 h-20 sm:h-40 bg-indigo-400 opacity-30 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute bottom-10 right-1/4 w-16 sm:w-32 h-16 sm:h-32 bg-blue-400 opacity-20 rounded-full blur-2xl animate-pulse"></div>
    </div>
    <div class="relative z-10 px-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 drop-shadow-lg animate-fade-in">
            Find Everything You Need
        </h1>
        <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 font-medium opacity-90 animate-fade-in delay-100">
            Browse the most popular categories and discover the latest ads!
        </p>
        <form action="{{ url('/search') }}" method="GET" class="max-w-xl mx-auto animate-fade-in delay-200">
            <div class="flex flex-col sm:flex-row items-center bg-white rounded-full shadow-lg overflow-hidden border-2 border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-400 transition-all duration-200">
                <input type="text" name="q" placeholder="Search ads..."
                       class="w-full px-4 sm:px-5 py-3 text-gray-700 focus:outline-none text-base sm:text-lg font-medium" required>
                <button type="submit"
                        class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-600 text-white px-6 sm:px-8 py-3 font-bold rounded-full sm:rounded-l-none transition-all duration-200 transform hover:scale-105 mt-2 sm:mt-0">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Categories Slider Section -->
<main class="max-w-7xl mx-auto px-4 py-6 sm:py-10">
    <div class="flex items-center justify-between mb-6 sm:mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-indigo-700">Browse Categories</h2>
        <div class="flex space-x-2">
            <button class="swiper-button-prev-custom p-2 rounded-full bg-white shadow-md hover:shadow-lg transition-all duration-200 text-indigo-600 hover:text-indigo-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="swiper-button-next-custom p-2 rounded-full bg-white shadow-md hover:shadow-lg transition-all duration-200 text-indigo-600 hover:text-indigo-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Categories Swiper -->
    <div class="swiper categoriesSwiper mb-8 sm:mb-12">
        <div class="swiper-wrapper">
            @foreach($categories as $category)
                <div class="swiper-slide">
                    <a href="{{ url('category/'.$category->slug) }}"
                       class="group block bg-white border border-indigo-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden cursor-pointer hover:border-indigo-400 focus:ring-2 focus:ring-indigo-400 h-full">
                        <div class="p-4 sm:p-6 lg:p-8 flex flex-col items-center justify-center h-full min-h-[200px]">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 mb-3 sm:mb-4 bg-indigo-100 rounded-full flex items-center justify-center group-hover:bg-indigo-200 transition">
                                <span class="text-xl sm:text-2xl lg:text-3xl text-indigo-600 font-bold">{{ strtoupper(substr($category->name,0,1)) }}</span>
                            </div>
                            <div class="text-lg sm:text-xl font-bold text-indigo-700 group-hover:text-indigo-900 transition-colors duration-200 mb-2 text-center">
                                {{ $category->name }}
                            </div>
                            <span class="bg-indigo-50 text-indigo-600 px-2 sm:px-3 py-1 rounded-full font-semibold text-xs shadow-sm mb-2">
                                {{ $category->ads_count ?? 0 }} ads
                            </span>
                            <span class="text-xs sm:text-sm text-gray-500 text-center">View ads in {{ $category->name }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Ads Section -->
    @if($categories->where('ads_count', '>', 0)->count() > 0)
        <div class="mb-8 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-indigo-700 mb-6 sm:mb-8 text-center">Latest Ads</h2>
            <div class="grid gap-4 sm:gap-6 lg:gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($categories->take(6) as $category)
                    @if($category->recent_ads && $category->recent_ads->count() > 0)
                        @foreach($category->recent_ads->take(1) as $ad)
                            <div class="bg-white border border-indigo-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group">
                                {{-- Image --}}
                                @if ($ad->getFirstMedia('ads'))
                                    <img src="{{ $ad->getFirstMediaUrl('ads', 'thumb') }}"
                                         alt="Ad image"
                                         class="w-full h-40 sm:h-48 object-cover rounded-t-2xl transition-transform duration-300 group-hover:scale-105" />
                                @else
                                    <div class="w-full h-40 sm:h-48 bg-indigo-50 flex items-center justify-center text-indigo-300 rounded-t-2xl text-base sm:text-lg font-semibold">
                                        No Image
                                    </div>
                                @endif

                                {{-- Card Content --}}
                                <div class="flex-1 flex flex-col p-4 sm:p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs bg-indigo-100 text-indigo-600 px-2 sm:px-3 py-1 rounded-full font-semibold tracking-wide shadow-sm">
                                            {{ $category->name }}
                                        </span>
                                        <span class="text-xs text-gray-400">{{ $ad->created_at->diffForHumans() }}</span>
                                    </div>

                                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-700 transition-colors duration-200">
                                        {{ Str::limit($ad->title, 50) }}
                                    </h3>

                                    <p class="text-gray-600 text-sm mb-4 flex-1">
                                        {{ Str::limit($ad->description, 80) }}
                                    </p>

                                    <div class="flex items-center justify-between mt-auto pt-2">
                                        <span class="text-indigo-700 font-extrabold text-base sm:text-lg">
                                            LKR {{ number_format($ad->price, 2) }}
                                        </span>
                                        <a href="{{ route('ads.show', $ad) }}"
                                           class="text-xs sm:text-sm font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-700 hover:to-blue-700 text-white px-3 sm:px-5 py-2 rounded-full shadow transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</main>

<!-- Footer -->
<footer class="bg-white/90 border-t mt-8 sm:mt-16 text-center text-sm text-gray-500 py-6 sm:py-8 shadow-inner">
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

// Categories Swiper
const categoriesSwiper = new Swiper('.categoriesSwiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
        nextEl: '.swiper-button-next-custom',
        prevEl: '.swiper-button-prev-custom',
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 24,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 32,
        },
        1280: {
            slidesPerView: 5,
            spaceBetween: 32,
        }
    },
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
});

// Simple fade-in animation
const style = document.createElement('style');
style.textContent = `
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px);}
    to { opacity: 1; transform: translateY(0);}
}
.animate-fade-in {
    animation: fade-in 1s cubic-bezier(.4,0,.2,1) both;
}
.animate-fade-in.delay-100 { animation-delay: .1s; }
.animate-fade-in.delay-200 { animation-delay: .2s; }
`;
document.head.appendChild(style);
</script>

</body>
</html>
