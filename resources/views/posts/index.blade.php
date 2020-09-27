@extends('_layouts.master')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form action="" role="search"></form>
      </div>
    </div>

    <div class="row">
      @if(count($posts) > 0)
      <div class="col-12">

        {{-- Laravel pagination --}}
        {{ $posts->links() }}

        @foreach($posts as $post)
        <article class="ui__card">
          <header class="card__header">
            <picture>
              <a href="/posts/{{ $post->id }}">
                <img src="https://picsum.photos/seed/picsum/300/200" alt="" />
                {{-- <img src="/storage/cover_image/{{ $post->cover_image }}" style="width: 100%;" /> --}}
              </a>
            </picture>
          </header>

          <div class="card__body">
            <p class="card__curation">Posted on {{ $post->created_at }} by {{ $post->user->name }}</p>
            <h2 class="card__title"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
          </div>

          <footer class="card__footer">
            
          </footer>
        </article>
        @endforeach

        {{-- Laravel pagination --}}
        {{ $posts->links() }}
      </div>

      @else
      <div class="col-12">
        <h2>No Posts found</h2>
      </div>
      @endif
    </div>
  </div>
@endsection