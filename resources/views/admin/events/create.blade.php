@extends('admin.layout.dashboard')
@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <div class="bg-white rounded-lg shadow-md overflow-hidden p-6">
            <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Create Your Event</h1>

            <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
                @csrf
                 <div class="form-group">
                            <label for="title" class="block text-sm font-bold text-gray-700 mb-1">Event Title</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                            id="title" name="title" placeholder="Enter event name" required>
                        </div>

                <div class="form-group">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-1">Description</label>
                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 min-h-[260px]"
                     id="description" name="description" placeholder="Tell people what your event is about..." required></textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="reset" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                        Clear Form
                    </button>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
