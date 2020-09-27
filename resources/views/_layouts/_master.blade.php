<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'LSApp') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
    @include('_includes.navbar')

    @include('_includes.notification')

    @yield('content')

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
      CKEDITOR.replace( 'article-ckeditor' );
    </script>
  </body>
</html>
