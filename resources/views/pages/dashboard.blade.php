@extends('_layouts.master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <header class='ui__toolbar'>
        <h2>Hello</h2>
        <p class="ui__field">
          <a class="ui__btn btn__primary" href="/posts/create">New Post</a>
        </p>
      </header>

      <h2>Saved Posts</h2>

      <h2>My Posts</h2>
      @if( count($posts) > 0 )
        @foreach($posts as $post)
        <article class="admin__post">
          <p>{{ $post->title }}</p>

          <div class="ui__controlbar">
            <p class="ui__field"><a class="ui__btn" href="/posts/{{ $post->id }}/edit">Edit</a></p>
            <p class="ui__field">
              {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'ui__btn']) }}
              {!! Form::close() !!}
            </p>
          </div>
        </article>
        @endforeach
      @else
      <p>You have no posts yet</p>
      @endif
    </div>

    <h2>All Posts</h2>
  </div>
</div>
@endsection
