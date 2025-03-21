@php
    /** @var \App\Models\Project[] $projects */
    /** @var \App\Models\User[] $users */
@endphp
<form method="POST" action="{{ $action }}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <!-- Project Selection -->
    <div class="mb-4">
        <label for="project_id" class="block font-semibold">Project</label>
        <select name="project_id" id="project_id" class="w-full border p-2 rounded">
            <option value="">Select Project</option>

            @foreach($projects as $project)
                <option
                    value="{{ $project->id }}" @selected(old('project_id', $task->project->id ?? '') == $project->id)>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
        @error('project_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Name -->
    <div class="mb-4">
        <label for="name" class="block font-semibold">Name</label>
        <input type="text" name="name" id="name" class="w-full border p-2 rounded"
               value="{{ old('name', $task->name ?? '') }}" required>
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div class="mb-4">
        <label for="description" class="block font-semibold">Description</label>
        <textarea name="description" id="description" class="w-full border p-2 rounded" rows="3"
                  required>{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Assigned To -->
    <div class="mb-4">
        <label for="assigned_to" class="block font-semibold">Assigned To</label>
        <select name="assigned_to" id="assigned_to" class="w-full border p-2 rounded">
            <option value="">Unassigned</option>
            @foreach($users as $user)
                <option
                    value="{{ $user->id }}" @selected(old('assigned_to', $task->assignedTo->id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('assigned_to')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Due Date -->
    <div class="mb-4">
        <label for="due_date" class="block font-semibold">Due Date</label>
        <input type="date" name="due_date" id="due_date" class="w-full border p-2 rounded"
               value="{{ old('due_date', $task->due_date ?? '') }}">
        @error('due_date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Status -->
    <div class="mb-4">
        <label for="status" class="block font-semibold">Status</label>
        <select name="status" id="status" class="w-full border p-2 rounded">
            @foreach(['to_do' => 'To Do', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $key => $label)
                <option value="{{ $key }}" @selected(old('status', $task->status ?? 'to_do') == $key)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Priority -->
    <div class="mb-4">
        <label for="priority" class="block font-semibold">Priority</label>
        <select name="priority" id="priority" class="w-full border p-2 rounded">
            @foreach(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $key => $label)
                <option value="{{ $key }}" @selected(old('priority', $task->priority ?? 'medium') == $key)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('priority')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            {{ $isEdit ? 'Update' : 'Create' }} Task
        </button>
    </div>
</form>
