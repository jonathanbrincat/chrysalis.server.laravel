@extends('_layouts.master')

@section('content')
<div class="row align-items-center justify-content-center">
  <div class="col-5">
    <h1>Join up now</h1>

    <form action="{{ route('register') }}" method="POST">
      {{ csrf_field() }}

      <div class="form__field field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="form__control">
          <span class="form__label">Name</span>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </label>
        @if($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>

      <div class="form__field field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="form__control">
          <span class="form__label">Email</span>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </label>
        @if($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>

      <div class="form__field field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="form__control">
          <span class="form__label">Password</span>
          <input type="password" id="password" name="password" required>
        </label>
        @if($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>

      <div class="form__field field form-group">
        <label class="form__control ">
          <span class="form__label">Confirm Password</span>
          <input type="password" id="password-confirm" name="password_confirmation" required>
        </label>
      </div>

      <div class="form__field field form-group">
        <button type="submit" class="ui__btn btn__primary">Sign up</button>
      </div>
    </form>
  </div>
</div>
@endsection
