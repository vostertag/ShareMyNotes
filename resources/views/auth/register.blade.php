@extends('layouts.app', ["body" => "align-center body-no-header"])
@section('pageTitle', 'Register')
@section('content')
<div class="container signup-container">
    <img class="mb-4 img-signup" src="{{ asset('images/bbLogo.png') }}" alt="" width="72" height="72">
    <div class="row justify-content-md-center">
        <div class="col-md-6 col-sm-12">

            <h2>Sign up as a {{ $role }}</h2>
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <hr>
            <form method='POST' action= "" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-row align-items-center">
                <div class="col-sm-6">
                  <label class="sr-only" for="inlineFormInput">First name</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="sr-only" for="inlineFormInput">Last name</label>
                  <input type="text" class="form-control mb-2" id="lastName" name="last_name" placeholder="Last Name">
                </div>
                <div class="col-sm-12">
                  <label class="sr-only" for="inlineFormInputGroup">Email</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-at"></i></div>
                    </div>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email address">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="sr-only" for="inlineFormInputGroup">Password</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-key"></i></div>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label class="sr-only" for="inlineFormInputGroup">Repeat password</label>
                  <div class="input-group mb-2">
                    <input type="password" class="form-control" id="passwordRepeat" name="password_confirmation" placeholder="Repeat password">
                  </div>
                </div>
                <div class="col-sm-12">
                  <label class="sr-only" for="inlineFormInputGroup">University</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-university"></i></div>
                    </div>
                    <select class="form-control" id="university" name="university">
                      @foreach($universities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="btn btn-dark">
                       <i class="fas fa-camera fa-lg"></i> <span class="fa-margin">Profile picture</span><input type="file" name="avatar" hidden>
                    </label>
                    <small> (Optional) </small>
                  </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success float-right btn-signup">Sign up</button>
                </div>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection