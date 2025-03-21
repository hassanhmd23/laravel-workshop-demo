<form method="POST" action="{{ $action }}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif
    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name', $project->name ?? '') }}"
               required>
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block font-semibold">Description</label>
        <textarea name="description"
                  class="w-full border p-2 rounded">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            {{ $isEdit ? 'Update' : 'Create' }} Project
        </button>
    </div>
</form>
