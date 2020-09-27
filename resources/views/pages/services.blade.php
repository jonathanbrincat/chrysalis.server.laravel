@extends('_layouts.master')

@section('content')
  <div class="container">    
    <h1>{{ $title }}</h1>
    <p>This is the services page</p>

    @if(count($services) > 0)
      <ul>
        @foreach($services as $service)
        <li>{{ $service }}</li>
        @endforeach
      </ul>
    @endif
  </div>
@endsection
