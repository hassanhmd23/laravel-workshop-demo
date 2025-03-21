@extends('layouts.app')
@section('title', 'Add new project')
@section('content')
    <x-project-form :action="route('projects.store')"/>
@endsection
