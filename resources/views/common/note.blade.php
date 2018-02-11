@extends('layouts.app', ["body" => "body-home"])

@section('pageTitle', 'Note')

@section('content')

@include('layouts.nav')

@include('layouts.sidenav')

<div class="container-fluid container-home">

  <div class="open-side">
    <button type="button" class="btn btn-primary"><i class="fas fa-arrow-right"></i> <span class="fa-margin">Open side menu</span></button>
  </div>

  <h2 class="title-home">{{ isset($note) ? 'Edit note: '.$note->title : 'Add a new note' }}</h2>

  <form class="form-note" method="post" action="{{ isset($note) ? route('editNote', $note->id) : route('addNote') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
      <label for="exampleFormControlInput1">Title of the note</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{ isset($note) ? $note->title : '' }}">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Note for the class: </label>
      <select class="form-control" id="exampleFormControlSelect1" name="course">
        @foreach($courses as $course)
          <option value="{{ $course->id }}" {{ isset($note) && $note->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Description</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" > {{ isset($note) ? $note->description : '' }} </textarea>
    </div>
    <div class="form-group">
      <label class="btn btn-dark">
       <i class="fas fa-file fa-lg"></i> <span class="fa-margin">Note's file</span><input type="file" name="file" hidden>
    </label>
    <small></small>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-add-note">{{isset($note) ? 'Update' : 'Add note'}}</button>
    </div>
  </form>

</div>

@endsection