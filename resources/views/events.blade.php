@extends('layouts.frontend')

@section('content')
  <section class="event">
    <h2>Upcoming Events</h2>
    <div class="event-card">
      <div class="event-grid">
        @forelse ($events as $event)
          <div class="event-item">
            <h3 class="title">{{ $event->title }}</h3>
            <p class="para">{{ $event->description }}</p>
            <h4 class="identify">Event #{{ $event->id }}</h4>

          </div>
        @empty
          <p class="empty">No events currently scheduled</p>
        @endforelse
       
      </div>
       {{-- <div class="mt-7 p-2">
            {{ $events->links() }}
        </div> --}}
    </div>
  </section>
@endsection

