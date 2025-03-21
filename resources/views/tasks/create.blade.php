@extends('layouts.app')
@section('title', 'Add new task')
@section('content')
    <x-task-form :action="route('tasks.store')" :projects="$projects" :users="$users"/>
@endsection
