@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 shadow rounded border-l-4 border-red-500">
            <h3 class="text-xl font-bold text-red-600">Projects</h3>
            <p class="text-gray-600">{{ $projectsCount }} projects</p>
        </div>
        <div class="bg-white p-6 shadow rounded border-l-4 border-red-500">
            <h3 class="text-xl font-bold text-red-600">Tasks</h3>
            <p class="text-gray-600">{{ $tasksCount }} tasks</p>
        </div>
    </div>
@endsection
