@extends('layouts.app', ["body" => "body-home"])

@section('pageTitle', 'Notes')

@section('content')

@include('layouts.nav')

@include('layouts.sidenav')

@include('layouts.notes')

@endsection