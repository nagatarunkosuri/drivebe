@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">User Management</h2>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add
            User</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($users as $user)
                    <tr>
                        <td class="border px-6 py-4">{{ $user->id }}</td>
                        <td class="border px-6 py-4">{{ $user->name }}</td>
                        <td class="border px-6 py-4">{{ $user->email }}</td>
                        <td class="border px-6 py-4">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="text-blue-500 hover:text-blue-600">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
