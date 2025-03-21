<form method="POST" action="{{ $action }}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif
    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name', $user->name ?? '') }}"
               required>
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block font-semibold">Email</label>
        <input name="email" type="email"
               class="w-full border p-2 rounded" value="{{ old('email', $user->email ?? '') }}" required>
        @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    {{--  show the password field when in create mode, and when in edit mode only show it when the authenticated user is the same as the user that is being updated  --}}
    @if(!$isEdit || auth()->user()->id === $user->id)
        <div class="mb-4">
            <label class="block font-semibold">Password</label>
            <input name="password" type="password"
                   class="w-full border p-2 rounded"
                   required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Confirm Password</label>
            <input name="password_confirmation" type="password"
                   class="w-full border p-2 rounded"
                   required>
        </div>
        @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    @endif
    <div class="mt-6">
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            {{ $isEdit ? 'Update' : 'Create' }} User
        </button>
    </div>
</form>
