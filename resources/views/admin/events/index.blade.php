@extends('admin.layout.dashboard')
@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="bg-white rounded-lg shadow-md overflow-hidden p-6">
            <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">List of events</h1>
           <div class="grid grid-cols-1 md:grid-cols-1 gap-4 p-4">
    @forelse ($events as $event)
        <article class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $event->title }}</h3>
            <p class="text-gray-600 mb-4">{{ $event->description }}</p>
            <div class="flex space-x-4">
                <a class=" bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition" href="{{ route('events.edit', $event->id) }}">Edit</a>
               <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                 @csrf
                 @method('DELETE')
                     <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Delete</button>
                </form>
            </div>
        </article>
    @empty
        <p class="text-gray-500 text-center col-span-full">No events currently scheduled</p>
    @endforelse
</div>
        </div>
    </div>
@endsection



