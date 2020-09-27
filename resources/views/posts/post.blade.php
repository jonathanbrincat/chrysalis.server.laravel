@extends('_layouts.master')

@section('content')
  <div class="container">
    <p>
      <a class="btn btn-default" href="/posts">Go back</a>  
    </p>

    {{-- DEVNOTE the double curly braces will not parse HTML(escaped) --}}
    <h1>{{ $post->title }}</h1>

    <img src="/storage/cover_image/{{ $post->cover_image }}" style="width: 100%;" />
    <br><br>

    {{-- DEVNOTE however using a single curly followed by two exclamations will(non-escaped = dangerous) --}}
    <p>{!! $post->body !!}</p>
    
    <hr />
    
    <p><small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small></p>
    
    {{-- User has to be logged in --}}
    @if(!Auth::guest())

      {{-- User has to match the post's user_id --}}
      @if(Auth::user()->id == $post->user_id)
      <hr />

      <a class="btn btn-default" href="/posts/{{ $post->id }}/edit">Edit</a>

      {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right']) !!}

      {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger float-right']) }}
      {!! Form::close() !!}
      @endif
    @endif
  </div>
@endsection