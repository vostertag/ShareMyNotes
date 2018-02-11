@extends('layouts.app', ["body" => "body-home"])

@section('pageTitle', 'Courses')

@section('content')

@include('layouts.nav')

@include('layouts.sidenav')

<div class="container-fluid container-home">

<div class="open-side">
	<button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i> <span class="fa-margin">Open side menu</span></button>
</div>

<h2 class="title-home">Classes from your university</h2>

@if($classes->count() == 0)
<div class="sorry-div">
<img src="{{ asset('images/sorry.png') }}" alt="Sorry" height="125px" style="position:relative; left:2px;">
<p style="margin-top:20px; color:red; font-weight: bold;">There is no courses yet, so there is nothing we can display here!</p>
@if($user->role == 1)
  <p><b>To add a note</b>, make sure to <b>create a course</b> and then <b>create a note</b> for this course. All of this can be done using the side bar.</p>
@else
  <p>It looks like your teachers have not created any course yet! Wait for them to do so, and you'll be able to join them here!</p>
@endif
</div>
@endif


	@foreach($classes as $index => $class)
	@if( ($index+1) % 3 == 1)
		<div class="row">
	@endif
	<div class="col-md-4">
		<div class="media class-container">
		  <img class="mr-3 note-picture" src="{{  url('image/'. $class->user->profile_picture) }}" alt="Generic placeholder image">
		  <div class="media-body note-body">
		    <h5 class="mt-0 note-title">{{ $class->name }}</h5>
		    <p class="note-info"><i class="fas fa-user"></i>  {{ $class->user->first_name . ' ' . $class->user->last_name }}
		    <div class="note-footer">
		    	@if( ($index+1) > $joined)
		    		<a href="{{ route('joinCourse', $class->id) }}"><button type="button" class="btn btn-outline-dark"><i class="fas fa-sign-in-alt"></i> <span class="fa-margin">Join</span></button></a>
		    	@else
		    		<a href="{{ route('leaveCourse', $class->id) }}"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times"></i> <span class="fa-margin">Leave</span></button></a>
		    	@endif
		  	</div>
		  </div>
		</div>	
	</div>
	@if( ($index+1)%3 == 0)
		</div>
	@endif
	@endforeach


</div>
</div>

@endsection