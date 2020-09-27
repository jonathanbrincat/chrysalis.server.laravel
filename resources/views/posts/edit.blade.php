@extends('_layouts.master')

@section('content')
  <div class="container">
    <h1>Edit Post</h1>

    {!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
      </div>
      <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'id' => 'article-ckeditor', 'placeholder' => 'Body text']) }}
      </div>
      <div class="form-group">
        {{-- DEVNOTE: generally acroynm, whenever you submit a file with a webform you need to have an 'enctype' attribute on the form set to 'multipart/form-data' --}}
        {{ Form::file('cover_image') }}
      </div>
      {{-- DEVNOTE: Webforms can only either GET or POST; to be a truly RESTful approach the associated method should be either PUT or PATCH. Laravel allows us to sproof these actions with a hidden input control to alias our desired method on the POST request --}}
      {{ Form::hidden('_method', 'PUT') }}

      {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
  </div>
@endsection