@extends('layouts.app', ["body" => "align-center body-no-header"])
@section('pageTitle', 'Login')
@section('content')
<form class="form-signin" method="POST">
    {{ csrf_field() }}
  <img class="mb-4" src="images/bbLogo.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
  <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
</form>
@endsection