@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    <div class="grid gap-8 lg:gap-12 md:grid-cols-5">

        {{-- Main Content --}}
        <div class="md:col-span-3">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                {{-- Image Gallery --}}
                @if ($ad->getMedia('ads')->count() > 0)
                    <div class="swiper adImageSwiper">
                        <div class="swiper-wrapper">
                            @foreach($ad->getMedia('ads') as $media)
                                <div class="swiper-slide">
                                    <img src="{{ $media->getUrl() }}" alt="Ad image" class="w-full h-64 sm:h-80 object-cover">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next text-white"></div>
                        <div class="swiper-button-prev text-white"></div>
                    </div>
                @else
                    <div class="w-full h-64 sm:h-80 bg-indigo-50 flex items-center justify-center text-indigo-300">
                        <svg class="w-16 h-16 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif

                {{-- Ad Details --}}
                <div class="p-4 sm:p-6 space-y-4">
                    <div class="flex flex-wrap items-center justify-between text-sm text-gray-500 gap-2">
                        <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 font-semibold">{{ $ad->category->name ?? 'Category' }}</span>
                        <span>Posted on: {{ $ad->created_at->toDayDateTimeString() }}</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900">{{ $ad->title }}</h1>
                    <p class="text-gray-700 leading-relaxed text-base">{{ $ad->description }}</p>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <aside class="md:col-span-2 space-y-6">
            {{-- Price Box --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="text-sm uppercase text-gray-500 tracking-wider">Price</div>
                <div class="text-3xl sm:text-4xl font-extrabold text-indigo-700 my-2">LKR {{ number_format($ad->price, 2) }}</div>
            </div>

            {{-- Contact Box --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 space-y-4">
                <h3 class="font-bold text-lg text-gray-800 border-b pb-2">Contact Seller</h3>
                <div>
                    <div class="text-xs uppercase text-gray-500">Location</div>
                    <div class="font-semibold text-gray-700">{{ optional($ad->district)->name ? optional($ad->district)->name . ', ' : '' }}{{ optional($ad->province)->name }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase text-gray-500">Contact Email</div>
                    <a href="mailto:{{ $ad->contact_email }}" class="font-semibold text-indigo-600 hover:underline">{{ $ad->contact_email ?: '—' }}</a>
                </div>
                <div class="pt-2">
                    <div class="text-xs uppercase text-gray-500 mb-1">Contact Phone</div>
                    @php
                        $phone = $ad->contact_phone;
                        $masked = $phone ? substr($phone, 0, 4) . str_repeat('•', max(0, strlen($phone) - 7)) . substr($phone, -3) : '—';
                    @endphp
                    <div class="flex items-center gap-3">
                        <span id="phoneDisplay" class="font-semibold text-lg select-all bg-gray-100 px-4 py-2 rounded-lg">{{ $masked }}</span>
                        <button id="revealPhone" type="button" class="p-3 rounded-full bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition-all duration-200" aria-label="Reveal phone">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M10 3C5.455 3 1.732 6.11.458 10 1.732 13.89 5.455 17 10 17s8.268-3.11 9.542-7C18.268 6.11 14.545 3 10 3zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Back Button --}}
            <div class="text-center">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-gray-700 hover:text-indigo-700 font-semibold group">
                    <svg class="w-4 h-4 mr-2 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to results
                </a>
            </div>
        </aside>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
.adImageSwiper .swiper-button-next, .adImageSwiper .swiper-button-prev {
    color: #fff;
    background-color: rgba(0,0,0,0.3);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    transition: background-color 0.2s;
}
.adImageSwiper .swiper-button-next:hover, .adImageSwiper .swiper-button-prev:hover {
    background-color: rgba(0,0,0,0.6);
}
.adImageSwiper .swiper-button-next::after, .adImageSwiper .swiper-button-prev::after {
    font-size: 18px;
    font-weight: bold;
}
.adImageSwiper .swiper-pagination-bullet-active {
    background: #fff;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    (function(){
        // Ad Image Swiper
        const adImageSwiper = new Swiper('.adImageSwiper', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        // Reveal Phone
        const btn = document.getElementById('revealPhone');
        const display = document.getElementById('phoneDisplay');
        if (btn && display) {
            btn.addEventListener('click', function(){
                display.textContent = @json($ad->contact_phone ?? '—');
                this.style.display = 'none';
            });
        }
    })();
</script>
@endpush
@endsection
