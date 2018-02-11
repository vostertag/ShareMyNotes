@extends('layouts.app', ["body" => "body-home"])

@section('pageTitle', 'Account')

@section('content')

@include('layouts.nav')

@include('layouts.sidenav')

<div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="addClass" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> <span class="fa-margin">Add a class</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body body-previous">
        <form>
		  <div class="form-group">
		    <input type="email" class="form-control" id="nameOfClass" placeholder="Name of the class">
		  </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid container-home">

<div class="open-side">
	<button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i> <span class="fa-margin">Open side menu</span></button>
</div>

<h2 class="title-home">Edit my account</h2>

<form class="form-note" method="post" action="" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="image-account">
		<img class="mr-3 image-account" src="{{  url('image/'.$user->profile_picture) }}" alt="Generic placeholder image">
	</div>
	@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
  <div class="form-row align-items-center">
    <div class="col-sm-6">
      <label class="sr-only" for="inlineFormInput">First name</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-user"></i></div>
        </div>
        <input type="text" class="form-control" id="firstName" placeholder="First name" name="first_name" value="{{ $user->first_name }}">
      </div>
    </div>
    <div class="col-sm-6">
      <label class="sr-only" for="inlineFormInput">Last name</label>
      <input type="text" class="form-control mb-2" id="lastName" placeholder="Last Name" name="last_name" value="{{ $user->last_name }}">
    </div>
    <div class="col-sm-12">
      <label class="sr-only" for="inlineFormInputGroup">Email</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-at"></i></div>
        </div>
        <input type="text" class="form-control" id="email" placeholder="Email address" name="email" value="{{ $user->email }}">
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
        <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Repeat password">
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
	      		<option value="{{ $university->id }}" {{ $university->id == $user->university_id ? "selected" : "" }}>{{ $university->name }}</option>
      		@endforeach
	    </select>
      </div>
      <div class="form-group">
	    <label class="btn btn-dark">
		   <i class="fas fa-camera fa-lg"></i> <span class="fa-margin">Profile picture</span><input type="file" name="avatar" hidden>
		</label>
		<small> (Optional) </small>
	  </div>
	  <div class="form-group">
	    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash-alt"></i> <span class="fa-margin">Delete my account</span></button>
      </div>
    </div>		    
    <div class="col-sm-12">
    	<button type="submit" class="btn btn-success float-right btn-signup">Update</button>
	</div>
  </div>
</form>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-trash-alt"></i> <span class="fa-margin">Delete my account</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('delete') }}"/>
      <div class="modal-body body-previous">
        <p> Are you sure about that? </p>
        {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
  	 </form>
    </div>
  </div>
</div>

</div>

@endsection