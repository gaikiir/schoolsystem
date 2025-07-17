@extends('admin.layout.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Assignment Button -->
    <div class="mb-6">
        <a href="{{ route('assignments.create') }}" 
           class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
            Create Assignment
        </a>
    </div>

    <!-- Assignments Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($assignments->isEmpty())
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No assignments found.</td>
                    </tr>
                @else
                    @foreach ($assignments as $assignment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $assignment->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $assignment->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{route('assignment.edit',$assignment)}}" 
                                   class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                                <form action="{{route('assignment.destroy',$assignment)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure?')" 
                                            class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection