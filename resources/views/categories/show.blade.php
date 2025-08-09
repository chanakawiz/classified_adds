@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Category Title --}}
    <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-10 text-center drop-shadow">
        {{ $category->name }} Ads
    </h1>

    @if ($ads->count())
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($ads as $ad)
                <div class="bg-white border border-indigo-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group">
                    {{-- Image --}}
                    @if ($ad->getFirstMedia('ads'))
                        <img src="{{ $ad->getFirstMediaUrl('ads', 'thumb') }}"
                             alt="Ad image"
                             class="w-full h-48 object-cover rounded-t-2xl transition-transform duration-300 group-hover:scale-105" />
                    @else
                        <div class="w-full h-48 bg-indigo-50 flex items-center justify-center text-indigo-300 rounded-t-2xl text-lg font-semibold">
                            No Image
                        </div>
                    @endif

                    {{-- Card Content --}}
                    <div class="flex-1 flex flex-col p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full font-semibold tracking-wide shadow-sm">
                                {{ $category->name }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $ad->created_at->diffForHumans() }}</span>
                        </div>

                        <h2 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-700 transition-colors duration-200">
                            {{ $ad->title }}
                        </h2>

                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($ad->description, 100) }}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-2">
                            <span class="text-indigo-700 font-extrabold text-lg">
                                LKR {{ number_format($ad->price, 2) }}
                            </span>
                            <a href="#"
                               class="text-sm font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-700 hover:to-blue-700 text-white px-5 py-2 rounded-full shadow transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $ads->links() }}
        </div>
    @else
        <div class="text-center text-gray-500 py-20">
            <svg class="mx-auto w-14 h-14 text-indigo-200 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.75 9.75h.008v.008H9.75V9.75zM14.25 9.75h.008v.008h-.008V9.75zM9.75 14.25h.008v.008H9.75v-.008zM14.25 14.25h.008v.008h-.008v-.008z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-lg">No ads found in this category yet.</p>
        </div>
    @endif
</div>
@endsection
