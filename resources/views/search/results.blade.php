@extends('layouts.app') {{-- or your main layout --}}

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    @if($ads->count())
        <ul>
            @foreach($ads as $ad)
                <li>
                    <a href="{{ url('ads/'.$ad->id) }}">{{ $ad->title }}</a>
                    <p>{{ Str::limit($ad->description, 100) }}</p>
                    <p>Price: {{ $ad->price ? '$' . $ad->price : 'N/A' }}</p>
                </li>
            @endforeach
        </ul>

        {{ $ads->links() }} {{-- pagination links --}}
    @else
        <p>No ads found.</p>
    @endif
@endsection
