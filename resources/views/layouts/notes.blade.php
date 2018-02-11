<div class="container-home container-fluid">

<div class="open-side">
	<button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i> <span class="fa-margin">Open side menu</span></button>
</div>

<h2 class="title-home">Notes</h2>

@if($notes->count() == 0)

@if(isset($search))
<div class="sorry-div">
  <p> Sorry, we didn't find any note corresponding to your search! </p>
</div>
@else
  <div class="sorry-div">
    <img src="{{ asset('images/sorry.png') }}" alt="Sorry" height="125px" style="position:relative; left:2px;">
    <p style="margin-top:20px; color:red; font-weight: bold;">You don't have any notes, so there is nothing we can display here!</p>
    @if($user->role == 1)
      <p><b>To add a note</b>, make sure to <b>create a course</b> and then <b>create a note</b> for this course. All of this can be done using the side bar.</p>
    @else
      <p><b>To add a note</b>, make sure you <b>joined a course</b> and then <b>create a note</b> for this course. All of this can be done using the side bar.</p>
    @endif
  </div>
@endif

@endif

@foreach($notes->sortByDesc('created_at') as $note)
  <div class="media note-container">
  <img class="mr-3 note-picture" src="{{  url('image/'. $note->user->profile_picture) }}" alt="Profile picture">
  <div class="media-body note-body">
    <h5 class="mt-0 note-title"> {{ $note->title }}
        @if($note->user->id == $user->id)
          <a class="edit" href="{{ route('editNote', $note->id) }}"><i class="fas fa-edit"></i></a>
        @endif
    </h5>
    <p class="note-info"><i class="fas fa-user"></i> {{ $note->user->first_name . ' ' . $note->user->last_name }} <span><i class="far fa-clock"></i> {{ $note->created_at->diffForHumans() }} </p></span>
    {{ $note->description }}
    <div class="note-footer">
      <a href="{{ route('file', $note->versions->last()->file) }}" download><button type="button" class="btn btn-outline-dark"><i class="fas fa-cloud-download-alt"></i> <span class="fa-margin">Download</span></button></a>

      <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalNote1"><i class="fas fa-hourglass-half"></i> <span class="fa-margin">Previous versions</span></button>
    </div>
  </div>
  </div>

  <div class="modal fade" id="modalNote1" tabindex="-1" role="dialog" aria-labelledby="modalNote1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-hourglass-half"></i> <span class="fa-margin">{{ $note->title }}</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body body-previous">
        @foreach($note->versions->sortByDesc('created_at') as $version)
          <p><a class="a-previous" href="{{ route('file', $version->file) }}" download> Version from {{ $version->created_at->toDateTimeString() }}</a></p>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>
@endforeach

</div>