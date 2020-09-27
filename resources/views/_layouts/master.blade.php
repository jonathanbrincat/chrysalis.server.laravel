<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('styles/main.css') }}" rel="stylesheet">
  </head>
  <body>
    <header id="app__masthead">
      @include('_includes.navbar')
    </header>

    <main id="app__body">
      @include('_includes.notification')

      @yield('content')
    </main>

    <footer id="app__footer">
      <div class="container">
        <p>Powered by pix'ie dust. Fuelled by tea. pix8 Ltd &copy; 2020.</p>
        <p><small>&hellip;something is brewing.</small></p>
      </div>
    </footer>

    <script src="{{ asset('scripts/main.js') }}"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>CKEDITOR.replace( 'article-ckeditor' );</script>
  </body>
</html>
