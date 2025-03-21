@extends('layouts.auth')

@section('content')
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-red-600 text-center">Login</h2>

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mt-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('authenticate') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email Address</label>
                <input type="email" id="email" name="email" required
                       class="w-full mt-1 p-3 border border-gray-300 rounded focus:ring-red-500 focus:border-red-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full mt-1 p-3 border border-gray-300 rounded focus:ring-red-500 focus:border-red-500">
            </div>

            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">
                Login
            </button>
        </form>
    </div>
@endsection
