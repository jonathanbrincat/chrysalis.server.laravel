@extends('_layouts.master')

@section('content')
  <div class="container">
    <h1>Create Post</h1>

    {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
      </div>
      <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Body text']) }}
      </div>
      <div class="form-group">
        {{-- DEVNOTE: generally acroynm, whenever you submit a file with a webform you need to have an 'enctype' attribute on the form set to 'multipart/form-data' --}}
        {{ Form::file('cover_image') }}
      </div>
      {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
  </div>
@endsection