@extends('admin.layout.dashboard')

@section('content')
    <!-- Programs Section -->
    <section class="py-8 bg-gray-100">
        <div class="container mx-auto px-4">
            <h3 class="text-2xl font-semibold mb-6 text-gray-800">Manage Programs</h3>
            <!-- Programs Table -->
            @if ($programs->isEmpty())
                <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                    <h5 class="text-lg font-medium">No Programs Available</h5>
                </div>
            @else
                <div class="bg-white rounded-lg shadow overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Description</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Duration</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Mode</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Level</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programs as $program)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $program->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($program->description, 50) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $program->duration }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $program->mode }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $program->level }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex space-x-2">
                                            <a href="{{route('programs.edit',$program->id)}}"
                                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                                Edit
                                            </a>
                                            <form action="{{route('programs.destroy',$program->id)}}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this program?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $programs->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </section>
@endsection