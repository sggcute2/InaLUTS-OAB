@extends('layouts.index')

@section('title')
Log In
@endsection

@section('content')
<form action="{{ route('login') }}" method="post">
  @csrf
  <div class="form-group has-feedback">
    <input type="text" name="username" id="username" class="form-control"
      value="{{ old('username') }}" placeholder="Username">
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="password" name="password" id="password" class="form-control"
      placeholder="Password">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <button type="submit" class="btn btn-primary btn-block btn-flat">
      Log In
    </button>
  </div>
</form>
@endsection
