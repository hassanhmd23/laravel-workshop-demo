@extends('layouts.app')
@section('title', 'Task')
@section('content')

    <p><strong>Name:</strong> {{ $task->name }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Created By:</strong> {{ $task->createdBy->name  }}</p>
    <p><strong>Assigned To:</strong> {{ $task->assignedTo->name ?? 'Unassigned' }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date ?? 'No due date' }}</p>
    <p>
        <strong>Status:</strong>
        <x-task-status :status="$task->status"/>
    </p>
    <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>

    <!-- Edit Button -->
    <a href="{{ route('tasks.edit', $task->id) }}"
       class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mt-4 inline-block">
        Edit Task
    </a>

    <!-- Comments Section -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-xl font-bold">Comments</h2>
        @foreach($task->comments as $comment)
            <div class="p-4 border-b">
                <p><strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->diffForHumans() }})</p>
                <p>{{ $comment->comment }}</p>
            </div>
        @endforeach
    </div>

    <!-- Add Comment Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-xl font-bold">Add a Comment</h2>
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <textarea name="comment" class="w-full border p-2 rounded" placeholder="Write a comment..."
                      required></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4">Add Comment
            </button>
        </form>
    </div>

@endsection
