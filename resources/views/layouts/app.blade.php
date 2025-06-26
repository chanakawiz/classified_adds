<!DOCTYPE html>
<html>
<head>
    <title>Classified Ads</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    @yield('content')
    <a href="{{ route('ads.create') }}">Post an Ad</a>

</div>
</body>
</html>
