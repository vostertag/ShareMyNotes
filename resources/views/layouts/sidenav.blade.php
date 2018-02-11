<div class="sidenav">
	<div class="close-side">
		<button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> <span class="fa-margin">Close side menu</span></button>
	</div>
	<h4 class="h4-sidebar">Courses</h4>
	<a href="{{ route('home') }}" class="a-sidebar{{ (!isset($current) or $current == 0) ? ' a-current' : ''}}">All</a>
  @if($user->role == 1)
	@foreach($user->courses as $course)
	  	<a href="{{ route('course', $course->id) }}" class="a-sidebar{{ (isset($current) && $current == $course->id) ? ' a-current' : ''}}">{{ $course->name }}</a>
	 @endforeach
   @else
   @foreach($user->course_users as $course)
      <a href="{{ route('course', $course->course->id) }}" class="a-sidebar{{ (isset($current) && $current == $course->course->id) ? ' a-current' : ''}}">{{ $course->course->name }}</a>
   @endforeach
   @endif
  @if($user->role == 1)
	  <button type="button" class="btn btn-outline-dark btn-sidenav" data-toggle="modal" data-target="#addClass"><i class="fas fa-plus"></i> Add a course</button>
  @endif
  @if($user->role == 2)
    <a href="{{ route('showCourses') }}"><button type="button" class="btn btn-outline-dark btn-sidenav"><i class="fas fa-plus"></i> Courses</button></a>
    <a href="{{ route('groups') }}"><button type="button" class="btn btn-outline-dark btn-sidenav"><i class="fas fa-users"></i> Groups</button></a>
  @endif
	  <a href="{{ route('newNote') }}"><button type="button" class="btn btn-outline-dark btn-sidenav"><i class="fas fa-pencil-alt"></i> Add a note</button></a>

</div>

@if($user->role == 1)
<div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-labelledby="addClass" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus"></i> <span class="fa-margin">Add a class</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('addCourse') }}">
      	{{ csrf_field() }}
      <div class="modal-body body-previous">
		  <div class="form-group">
		    <input type="text" name="name" class="form-control" id="nameOfClass" placeholder="Name of the class">
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
@endif