@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12">

    {{-- Category Title --}}
    <div class="text-center mb-8 sm:mb-12">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-indigo-700 mb-4 drop-shadow">
            {{ $category->name }} Ads
        </h1>
        <p class="text-gray-600 text-sm sm:text-base">
            Showing {{ $ads->total() }} ads in {{ $category->name }}
        </p>
    </div>

    @if ($ads->count())
        {{-- Filter and Sort Options --}}
        <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
            <div class="flex flex-wrap gap-2">
                <span class="text-sm text-gray-600 font-medium">Sort by:</span>
                <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    <option>Latest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Oldest</option>
                </select>
            </div>
            <div class="text-sm text-gray-500">
                {{ $ads->firstItem() }}-{{ $ads->lastItem() }} of {{ $ads->total() }} results
            </div>
        </div>

        {{-- Ads Grid --}}
        <div class="grid gap-4 sm:gap-6 lg:gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($ads as $ad)
                <div class="bg-white border border-indigo-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group">
                    {{-- Image --}}
                    @if ($ad->getFirstMedia('ads'))
                        <div class="relative overflow-hidden">
                            <img src="{{ $ad->getFirstMediaUrl('ads', 'thumb') }}"
                                 alt="Ad image"
                                 class="w-full h-40 sm:h-48 object-cover rounded-t-2xl transition-transform duration-300 group-hover:scale-105" />
                            {{-- Price Badge --}}
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full shadow-lg">
                                <span class="text-indigo-700 font-bold text-sm">
                                    LKR {{ number_format($ad->price, 0) }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-40 sm:h-48 bg-indigo-50 flex items-center justify-center text-indigo-300 rounded-t-2xl text-base sm:text-lg font-semibold relative">
                            <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{-- Price Badge --}}
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full shadow-lg">
                                <span class="text-indigo-700 font-bold text-sm">
                                    LKR {{ number_format($ad->price, 0) }}
                                </span>
                            </div>
                        </div>
                    @endif

                    {{-- Card Content --}}
                    <div class="flex-1 flex flex-col p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs bg-indigo-100 text-indigo-600 px-2 sm:px-3 py-1 rounded-full font-semibold tracking-wide shadow-sm">
                                {{ $category->name }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $ad->created_at->diffForHumans() }}</span>
                        </div>

                        <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-700 transition-colors duration-200 line-clamp-2">
                            {{ $ad->title }}
                        </h2>

                        <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">
                            {{ Str::limit($ad->description, 100) }}
                        </p>

                        {{-- Location --}}
                        @if($ad->district || $ad->province)
                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ optional($ad->district)->name ? optional($ad->district)->name . ', ' : '' }}{{ optional($ad->province)->name }}</span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-100">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500">Price</span>
                                <span class="text-indigo-700 font-extrabold text-lg">
                                    LKR {{ number_format($ad->price, 2) }}
                                </span>
                            </div>
                            <a href="{{ route('ads.show', $ad) }}"
                               class="text-xs sm:text-sm font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-700 hover:to-blue-700 text-white px-4 sm:px-5 py-2 rounded-full shadow transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 sm:mt-12 flex justify-center">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                {{ $ads->links() }}
            </div>
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center text-gray-500 py-16 sm:py-20">
            <div class="max-w-md mx-auto">
                <svg class="mx-auto w-16 h-16 sm:w-20 sm:h-20 text-indigo-200 mb-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9.75 9.75h.008v.008H9.75V9.75zM14.25 9.75h.008v.008h-.008V9.75zM9.75 14.25h.008v.008H9.75v-.008zM14.25 14.25h.008v.008h-.008v-.008z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-700 mb-2">No ads found</h3>
                <p class="text-base sm:text-lg mb-6">No ads have been posted in this category yet.</p>
                <a href="{{ route('ads.create') }}"
                   class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-700 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Post the First Ad
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

{{-- Custom Styles for line-clamp --}}
@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 640px) {
    .line-clamp-2 {
        -webkit-line-clamp: 1;
    }
    .line-clamp-3 {
        -webkit-line-clamp: 2;
    }
}
</style>
@endpush
