@extends('admin.layout.dashboard')

@section('content')
<section class="bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <form method="POST" action="{{ route('programs.update', $program->id) }}">
            @csrf
            @method('PUT')
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Edit Your Course</h2>
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $program->title) }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Course Title" required>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="8" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Course Description">{{ old('description', $program->description) }}</textarea>
                </div>
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration (Months)</label>
                    <input type="text" id="duration" name="duration" value="{{ old('duration', $program->duration) }}" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Duration in Months" required>
                </div>
                <div>
                    <label for="mode" class="block text-sm font-medium text-gray-700">Mode</label>
                    <select id="mode" name="mode" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="" disabled {{ old('mode', $program->mode) == '' ? 'selected' : '' }}>Select Mode</option>
                        <option value="online" {{ old('mode', $program->mode) == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="in-person" {{ old('mode', $program->mode) == 'in-person' ? 'selected' : '' }}>In-Person</option>
                        <option value="hybrid" {{ old('mode', $program->mode) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                    <select id="level" name="level" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="" disabled {{ old('level', $program->level) == '' ? 'selected' : '' }}>Select Level</option>
                        <option value="beginner" {{ old('level', $program->level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('level', $program->level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ old('level', $program->level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection