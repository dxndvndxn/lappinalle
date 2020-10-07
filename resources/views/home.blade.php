<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lappinalle</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--    <script type="text/javascript" src="https://app.frisbie.me/api/messageus/9d3c0fc3-a9e5-45db-cac6-08d852310b77" async defer></script>--}}
</head>
<body>
    <div id="app">
{{--      <Appi></Appi>--}}
    </div>

{{--    {!! $ssr !!}--}}
{{--    <script src="{{ asset('js/manifest.js') }}" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('js/vendor.js') }}" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('js/entry-client.js') }}" type="text/javascript"></script>--}}
</body>
</html>
