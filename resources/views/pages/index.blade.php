@extends('_layouts.master')

@section('content')
  <div class="container">
    <div class="jumbotron text-center">
      <h1>Welcome to Laravel</h1>
      <p>
        <a href="/login" class="btn btn-primary btn-lg">Login</a>
        <a href="/register" class="btn btn-success btn-lg">Register</a>
      </p>
    </div>

    <!-- snippet came from welcome.blade.php template that ships with laravel -->
    <div class="flex-center text-center">
      @if(Route::has('login'))
      <div class="top-right links">
        @auth
          <a href="{{ url('/home') }}">Home</a>
        @else
          <a href="{{ route('login') }}">Login</a>
          <a href="{{ route('register') }}">Register</a>
        @endauth
      </div>
      @endif
    </div>
  </div>
@endsection
