@extends('layouts.app')
@section('title', 'Edit Project')
@section('content')
    <x-project-form :action="route('projects.update', $project->id)" :is-edit="true" :project="$project"/>
@endsection
