@extends('_layouts.master')

@section('content')
  <div class="container">
    <div class="jumbotron text-center">
      <h1>Welcome to Laravel</h1>

      <!-- snippet came from welcome.blade.php template that ships with laravel -->
      @if(Route::has('login'))
        @auth
          <p><a href="{{ url('/posts') }}">My Posts</a></p>
        @else
          <p><a href="{{ route('login') }}">Login</a></p>
          <p><a href="{{ route('register') }}">Sign up</a></p>
        @endauth
      @endif
    </div>
  </div>
@endsection
