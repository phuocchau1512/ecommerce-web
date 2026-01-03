<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Furni')</title>

  <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

  <!-- CSS -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/product-detail.css') }}">
</head>

<body>

    {{-- HEADER --}}
    @include('partials.header')

    {{-- CONTENT --}}
    @yield('content')

    {{-- FOOTER --}}
    @include('partials.footer')

    <!-- JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
