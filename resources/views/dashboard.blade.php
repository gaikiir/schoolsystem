@extends('admin.layout.dashboard')

@section('content')
<section class="bg-gray-100 p-4">
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Student List</h3>
        <div class="overflow-x-auto">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">User ID</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $user->id }}</td>
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">
                                @php
                                    $statusColors = [
                                        'approved' => 'bg-green-200 text-green-800',
                                        'blocked' => 'bg-red-200 text-red-800',
                                        'pending' => 'bg-yellow-200 text-yellow-800'
                                    ];
                                @endphp
                                <span class="{{ $statusColors[$user->status] ?? 'bg-gray-200 text-gray-800' }} py-1 px-3 rounded-full text-xs">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex flex-wrap items-center justify-center gap-2">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="" disabled {{ !$user->role ? 'selected' : '' }}>Select Role</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded hover:bg-green-600 transition text-sm">Update</button>
                                    </form>
                                    <div class="flex gap-2">
                                        <form action="{{ route('users.approve', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 text-white px-3 py-1.5 rounded hover:bg-blue-600 transition text-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('users.block', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded hover:bg-red-600 transition text-sm">Block</button>
                                        </form>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-gray-500 text-white px-3 py-1.5 rounded hover:bg-gray-600 transition text-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Program Notifications Table -->
    @if (session('program_notification'))
        <div class="bg-white p-6 rounded-lg shadow mb-6" id="program-notification">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Recent Program Creation</h3>
                <button onclick="document.getElementById('program-notification').remove()" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-600">
                            <th class="p-2">Program Title</th>
                            <th class="p-2">Date</th>
                            <th class="p-2">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="p-2">{{ session('program_notification.title') }}</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse(session('program_notification.created_at'))->format('M d, Y') }}</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse(session('program_notification.created_at'))->format('H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Link to Manage All Programs -->
    <div class="mt-6">
        <a href="{{ route('programs.index') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Manage All Programs
        </a>
    </div>
</section>

<!-- JavaScript to hide notification after 24 hours -->
@if (session('program_notification'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const createdAt = new Date('{{ session('program_notification.created_at') }}');
            const now = new Date();
            const hoursDiff = (now - createdAt) / (1000 * 60 * 60); // Difference in hours
            const notificationDiv = document.getElementById('program-notification');

            if (notificationDiv && hoursDiff > 24) {
                notificationDiv.remove();
            }
        });
    </script>
@endif
@endsection