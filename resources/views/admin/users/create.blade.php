@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
    <div class="mb-4">
        <h2 class="text-lg font-semibold">Create User</h2>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 block w-full border-gray-300 rounded-md"
                required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 p-2 block w-full border-gray-300 rounded-md"
                required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 p-2 block w-full border-gray-300 rounded-md"
                required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="mt-1 p-2 block w-full border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea name="address" id="address" rows="3" class="mt-1 p-2 block w-full border-gray-300 rounded-md"></textarea>
        </div>

        <!-- Add more fields as needed -->

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create</button>
        </div>
    </form>
@endsection
