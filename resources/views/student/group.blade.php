@extends('layouts.app', ["body" => "body-home"])

@section('pageTitle', 'Groups')

@section('content')

@include('layouts.nav')

@include('layouts.sidenav')

<div class="container-fluid container-home">

	<div class="open-side">
		<button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i> <span class="fa-margin">Open side menu</span></button>
	</div>

	<h2 class="title-home">Your Groups</h2>

	@if($groups->count() == 0)
	<div class="sorry-div">
    <p style="margin-top:20px; color:red; font-weight: bold;">You don't have any groups yet!</p>
    @if($user->role == 1)
      <p><b>To add a note</b>, make sure to <b>create a course</b> and then <b>create a note</b> for this course. All of this can be done using the side bar.</p>
    @else
      <p><b>To add a group</b>, <b>press the button below</b> or <b>ask a friend for an invite!</b></p>
    @endif
  </div>
  @endif


	@foreach($groups as $index => $group)
	@if( ($index+1) % 3 == 1)
		<div class="row">
	@endif
	<div class="col-md-4">
			<div class="media class-container">
			  
			  <div class="media-body note-body">
			    <h5 class="mt-0 note-title">{{ $group->name }}</h5>
			    <p class="note-info"><i class="fas fa-users"></i> <b>Members: </b></p>
			    <p class="note-info">
			    	{{ $group->members_string() }}
			    </p>
			    <div class="note-footer">
			    	<a href="{{ route('leaveGroup', $group->id) }}}}"><button type="button" class="btn btn-outline-danger"><i class="fas fa-times"></i> <span class="fa-margin">Leave</span></button></a>
			    	<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalGroup1"><i class="fas fa-plus"></i> <span class="fa-margin">Add a friend</span></button>
			  	</div>
			  </div>
			</div>	
		</div>

		<div class="modal fade" id="modalGroup1" tabindex="-1" role="dialog" aria-labelledby="modalGroup1" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> <span class="fa-margin">Invite to the group</span></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body body-previous">
	        <p> Send this link to your friend to invite them! </p>
	        <p> {{ route('joinGroup', $group->token) }}</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Got it!</button>
	      </div>
	    </div>
	  </div>
	</div>
	@if( ($index+1)%3 == 0)
		</div>
	@endif
	@endforeach

</div>

<div class="btn-add-group-div">
<button type="button" class="btn btn-outline-success btn-add-group" data-toggle="modal" data-target="#addGroup">Create a group</button>
</div>

<div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="addGroup" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> <span class="fa-margin">Add a group</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('addGroup') }}">
      	{{ csrf_field() }}
      <div class="modal-body body-previous">
		  <div class="form-group">
		    <input type="text" name="name" class="form-control" id="nameOfClass" placeholder="Name of the group">
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" >Add</button>
      </div>
      </form>
    </div>
  </div>
</div>



@endsection