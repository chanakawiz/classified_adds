

@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- Show category title --}}
        <h1 class="text-4xl font-bold text-gray-900 mb-8">
            {{ $category->name }} Ads
        </h1>

        @if ($ads->count())
            <div class="space-y-8">
                @foreach ($ads as $ad)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-lg transition duration-300 overflow-hidden flex space-x-6 p-6 items-center">
                        {{-- Image Left --}}
                        @if ($ad->getFirstMedia('ads'))
                            <img src="{{ $ad->getFirstMediaUrl('ads', 'thumb') }}"
                                 alt="Ad image"
                                 class="w-24 h-24 object-cover rounded-lg flex-shrink-0" />
                        @else
                            <div class="w-24 h-24 bg-gray-200 flex items-center justify-center text-gray-400 rounded-lg flex-shrink-0">
                                No Image
                            </div>
                        @endif

                        {{-- Text content right --}}
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full font-medium">
                                    {{ $category->name }}
                                </span>
                                <span class="text-xs text-gray-500">{{ $ad->created_at->diffForHumans() }}</span>
                            </div>

                            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                {{ $ad->title }}
                            </h2>

                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit($ad->description, 100) }}
                            </p>

                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold text-lg">
                                    LKR {{ number_format($ad->price, 2) }}
                                </span>
                                <a href="#" class="text-sm text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-full transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $ads->links() }}
            </div>
        @else
            <div class="text-center text-gray-500 py-20">
                <svg class="mx-auto w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9.75 9.75h.008v.008H9.75V9.75zM14.25 9.75h.008v.008h-.008V9.75zM9.75 14.25h.008v.008H9.75v-.008zM14.25 14.25h.008v.008h-.008v-.008z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>No ads found in this category yet.</p>
            </div>
        @endif
    </div>
@endsection
