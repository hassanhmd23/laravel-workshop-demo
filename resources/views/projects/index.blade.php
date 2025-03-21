@php
    /**
     * @var \App\Models\Project $project
     */
@endphp
@extends('layouts.app')
@section('title', 'Projects')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <a href="{{ route('projects.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            + New Project
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
        <table class="w-full table-auto">
            <thead>
            <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                <th class="p-2">Name</th>
                <th class="p-2">Created By</th>
                <th class="p-2"># Of Tasks</th>
                <th class="p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr class="border-b">
                    <td class="p-2">{{ $project->name }}</td>
                    <td class="p-2">{{ $project->createdBy->name }}</td>
                    <td class="p-2">{{ $project->tasks_count }}</td>
                    <td class="p-2 flex gap-2">
                        <a href="{{ route('projects.show', $project->id) }}"
                           class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('projects.edit', $project->id) }}"
                           class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
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
@endsection
