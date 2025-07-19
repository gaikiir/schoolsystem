@extends('layouts.frontend')

@section('content')
  <section class="bg-gradient-to-b from-blue-50 to-white py-16">
    <h2 class="text-5xl font-extrabold text-center text-gray-600 mb-12 tracking-wide">Upcoming Events</h2>
    <div class="container  mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($events as $event)
          <div class=" bg-white rounded-2xl shadow-md p-8 hover:shadow-2xl transition-all duration-300 border border-gray-100">
            <h3 class="text-3xl font-bold text-gray-600 mb-4">{{ $event->title }}</h3>
            <p class="text-gray-600 leading-relaxed mb-5">{{ $event->description }}</p>
            <h4 class="text-base font-semibold text-gray-600">Event #{{ $event->id }}</h4>
          </div>
        @empty
          <p class="empty col-span-full text-center text-gray-600 text-xl py-10 font-medium">No events currently scheduled</p>
        @endforelse
      </div>
      {{-- <div class="mt-7 p-2">
            {{ $events->links() }}
      </div> --}}
    </div>
  </section>
@endsection