<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src='{{ asset("public/js/jquery36.min.js") }}'></script>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/toastr.scss') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
    @yield("header")

    <title>{{ env('APP_NAME') }}@yield("title")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body>
@yield("body")
</body>

<footer>
@extends("footer")
@yield("footer")
</footer>
