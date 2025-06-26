{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <h1>Create a New Ad</h1>--}}

{{--    @if ($errors->any())--}}
{{--        <div>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li style="color: red">{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form action="{{ route('ads.store') }}" method="POST">--}}
{{--        @csrf--}}

{{--        <div>--}}
{{--            <label>Title:</label>--}}
{{--            <input type="text" name="title" value="{{ old('title') }}" required>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <label>Description:</label>--}}
{{--            <textarea name="description" required>{{ old('description') }}</textarea>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <label>Category:</label>--}}
{{--            <select name="category_id" required>--}}
{{--                <option value="">Select a Category</option>--}}
{{--                @foreach ($categories as $category)--}}
{{--                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>--}}
{{--                        {{ $category->name }}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <label>Price:</label>--}}
{{--            <input type="number" step="0.01" name="price" value="{{ old('price') }}">--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <label>Contact Email:</label>--}}
{{--            <input type="email" name="contact_email" value="{{ old('contact_email') }}">--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <label>Contact Phone:</label>--}}
{{--            <input type="text" name="contact_phone" value="{{ old('contact_phone') }}">--}}
{{--        </div>--}}

{{--        <button type="submit">Post Ad</button>--}}
{{--    </form>--}}
{{--@endsection--}}
