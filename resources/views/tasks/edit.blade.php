@extends('layouts.app')
@section('title', 'Edit task')
@section('content')
    <x-task-form :action="route('tasks.update', $task->id)" :projects="$projects" :users="$users" :is-edit="true" :task="$task"/>
@endsection
