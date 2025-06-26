{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Classified Ads</title>--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container">--}}
{{--    @yield('content')--}}
{{--    <a href="{{ route('ads.create') }}">Post an Ad</a>--}}

{{--</div>--}}
{{--</body>--}}
{{--</html>--}}


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Classified Ads')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- THIS IS IMPORTANT: Vite CSS/JS loader -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
@yield('content')
</body>
</html>
