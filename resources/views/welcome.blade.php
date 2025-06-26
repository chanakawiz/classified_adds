<!DOCTYPE html>
<html>
<head>
    <title>Classified Ads</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav>
    <ul>
        @foreach($categories as $category)
            <li><a href="{{ url('category/'.$category->slug) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</nav>

<form action="{{ url('/search') }}" method="GET">
    <input type="text" name="q" placeholder="Search ads...">
    <button type="submit">Search</button>
</form>

<h1>Welcome to Classified Ads</h1>
</body>
</html>
