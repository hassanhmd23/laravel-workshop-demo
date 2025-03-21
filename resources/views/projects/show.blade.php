@extends('layouts.app')
@section('title', 'User')
@section('content')

    <p><strong>Name:</strong> {{ $project->name }}</p>
    <p><strong>Description:</strong> {{ $project->description }}</p>

    <div class="bg-white shadow-md rounded my-6">
        <div class="px-4 py-2 border-b">
            <h2 class="text-2xl">Tasks</h2>
        </div>
        <ul>
            @forelse($project->tasks as $task)
                <li class="px-4 py-2 border-b flex justify-between items-center">
                    <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500">{{ $task->name }}</a>
                    <span class="text-sm">{{ $task->created_at->diffForHumans() }}</span>
                </li>
            @empty
                <li class="px-4 py-2 border-b">No tasks found</li>
            @endforelse
        </ul>
@endsection
