@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid gap-8 md:grid-cols-5">
        <div class="md:col-span-3">
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                @if ($ad->getFirstMedia('ads'))
                    <img src="{{ $ad->getFirstMediaUrl('ads') }}" alt="Ad image" class="w-full h-80 object-cover">
                @else
                    <div class="w-full h-80 bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
                @endif

                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 font-semibold">{{ $ad->category->name ?? 'Category' }}</span>
                        <span>{{ $ad->created_at->toDayDateTimeString() }}</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">{{ $ad->title }}</h1>
                    <p class="text-gray-700 leading-relaxed">{{ $ad->description }}</p>
                </div>
            </div>
        </div>

        <aside class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <div>
                    <div class="text-xs uppercase text-gray-500">Price</div>
                    <div class="text-2xl font-extrabold text-indigo-700">LKR {{ number_format($ad->price, 2) }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase text-gray-500">Location</div>
                    <div class="font-semibold">{{ optional($ad->district)->name ? optional($ad->district)->name . ', ' : '' }}{{ optional($ad->province)->name }}</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <div>
                    <div class="text-xs uppercase text-gray-500">Contact Email</div>
                    <div class="font-semibold">{{ $ad->contact_email ?: '—' }}</div>
                </div>

                <div class="pt-2">
                    <div class="text-xs uppercase text-gray-500">Contact Phone</div>
                    @php
                        $phone = $ad->contact_phone;
                        $masked = $phone ? substr($phone, 0, 4) . str_repeat('•', max(0, strlen($phone) - 4)) : '—';
                    @endphp
                    <div class="flex items-center gap-2">
                        <button id="revealPhone" type="button" class="p-2 rounded-full bg-indigo-50 text-indigo-700 hover:bg-indigo-100" aria-label="Reveal phone">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M10 3C5.455 3 1.732 6.11.458 10 1.732 13.89 5.455 17 10 17s8.268-3.11 9.542-7C18.268 6.11 14.545 3 10 3zm0 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6z"/></svg>
                        </button>
                        <span id="phoneDisplay" class="font-semibold select-all">{{ $masked }}</span>
                    </div>
                </div>
            </div>

            <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm text-gray-700 hover:text-indigo-700">
                ← Back
            </a>
        </aside>
    </div>
</div>

<script>
    (function(){
        const btn = document.getElementById('revealPhone');
        const display = document.getElementById('phoneDisplay');
        if (btn && display) {
            btn.addEventListener('click', function(){
                display.textContent = @json($ad->contact_phone ?? '—');
            });
        }
    })();
</script>
@endsection

