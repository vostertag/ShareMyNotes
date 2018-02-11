@extends('layouts.app', ["body" => "align-center body-no-header"])
@section('pageTitle', 'Welcome')
@section('content')
<div class="container fill container-landing-page">

    <img class="landing-logo" src="{{ asset('images/bbLogo.png') }}" alt="Logo"/>

    <p class="landing-intro align-center"><b>ShareMyNotes</b> is a free collaborative platform for archival and
sharing of class notes and student coursework.</p>

    <a href="{{ route('login') }}"><button type="button" class="btn btn-outline-success btn-lg btn-login"> 
    <i class="fas fa-unlock-alt fa-lg"></i>
    Sign in
    </button></a>

    <p class="landing-intro align-center"> OR </p>

    <div class="row row-signup">
        <div class="col-sm-6 btn-signup-left"> 
            <a href="{{ route('register', 'teacher') }}"><button type="button" class="btn btn-outline-primary btn-lg"><i class="fas fa-briefcase fa-lg"></i> Sign up as a teacher</button></a>
        </div>
        <div class="col-sm-6 btn-signup-right">
            <a href="{{ route('register', 'student') }}"><button type="button" class="btn btn-outline-primary btn-lg"><i class="fas fa-graduation-cap fa-lg"></i> Sign up as a student</button></a>
        </div>
    </div>

</div>
@endsection