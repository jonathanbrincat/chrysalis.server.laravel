@extends('_layouts.master')

@section('content')
  <div class="container">
    <div class="jumbotron text-center">
      <h1>Welcome to Laravel</h1>
      {{-- <h2>{{ $title }}</h2> --}}
      <p>This is the Laravel application from the "Laravel from Scratch" Youtube series courtesy of Traversy Media</p>
      <p><a href="https://github.com/bradtraversy/lsapp">https://github.com/bradtraversy/lsapp</a></p>
      <p>
        <a href="/login" class="btn btn-primary btn-lg">Login</a>
        <a href="/register" class="btn btn-success btn-lg">Register</a>
      </p>
    </div>
  </div>
@endsection
