<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Social</title>

	</head>
    <body>	
        <div id="app">
    		@include('pages.template.partials.navigation')
            @include('alert')
    		@yield('content')
        </div>
	</body>
</html>