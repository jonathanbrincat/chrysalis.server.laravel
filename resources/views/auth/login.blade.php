@extends('_layouts.master')

@section('content')
<div class="row align-items-center justify-content-center">
  <div class="col-5">
    <h1>Login</h1>

    <form action="{{ route('login') }}" method="POST">
      {{ csrf_field() }}

      <div class="form__field field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="form__control">
          <span class="form__label">Email</span>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
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
        <label class="form__control">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
      </div>

      <div class="form__field field form-group">
        <button type="submit" class="ui__btn btn__primary">Login</button>

        <p><a href="{{ route('password.request') }}">Forgot Your Password?</a></p>
      </div>
    </form>
  </div>
</div>
@endsection
