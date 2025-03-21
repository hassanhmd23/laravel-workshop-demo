@php
    /**
    * @var \App\Models\Task[] $tasks
    * @var \App\Models\Project[] $projects
    * @var \App\Models\User[] $users
    */
@endphp
@extends('layouts.app')
@section('title', 'Tasks')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <form method="GET" action="{{ route('tasks.index') }}" class="flex gap-4">
            <select name="project" class="border rounded p-2">
                <option value="">All Projects</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ request('project') == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>

            <select name="assigned_to" class="border rounded p-2">
                <option value="">All Assignees</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Filter
            </button>
        </form>

        <a href="{{ route('tasks.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            + New Task
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
        <table class="w-full table-auto">
            <thead>
            <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                <th class="p-2">Name</th>
                <th class="p-2">Project</th>
                <th class="p-2">Assigned To</th>
                <th class="p-2">Status</th>
                <th class="p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr class="border-b">
                    <td class="p-2">{{ $task->name }}</td>
                    <td class="p-2">{{ $task->project->name }}</td>
                    <td class="p-2">{{ $task->assignedTo->name ?? 'Unassigned' }}</td>
                    <td class="p-2">
                        <x-task-status :status="$task->status"/>
                    </td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('tasks.show', $task->id) }}"
                           class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('tasks.edit', $task->id) }}"
                           class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                              onsubmit="return confirm('Delete this task?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
@endsection
