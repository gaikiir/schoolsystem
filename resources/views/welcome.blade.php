@extends('layouts.frontend')

@section('content')
  <section class="hero">
    <div class="hero-wrapper">
      <h1>Unleash Your Potential</h1>
      <p>Transform the way you work with our cutting-edge platform built for innovation and efficiency.</p>
      <div class="hero-cta">
      </div>
    </div>
  </section>

  <section class="benefits">
    <h2>Why Choose Us?</h2>
    {{-- <div class="benefits-grid">
        @forelse ($cards as $card)
      <div class="benefit-card" >
        <h3> {{$card->title}} </h3>
        <p> {{$card->description}} </p>
      </div>
        @empty
        <p class="empty">No content currently scheduled</p>
        @endforelse
    </div> --}}
  </section>

  <section class="reviews">
    <h2>What Our Users Say</h2>
    <div class="reviews-grid">
      <div class="review-card">
        <div class="rating">★★★★★</div>
        <p>"This platform has completely transformed how I manage my projects. The interface is intuitive, and the support team is always there when I need them!"</p>
        <div class="reviewer">Sarah M.</div>
      </div>
      <div class="review-card">
        <div class="rating">★★★★☆</div>
        <p>"Super fast and reliable! I wish there were a few more customization options, but overall, it's been a game-changer for my business."</p>
        <div class="reviewer">James T.</div>
      </div>
      <div class="review-card">
        <div class="rating">★★★★★</div>
        <p>"I can't recommend this platform enough. It's easy to use, and the performance is outstanding. Worth every penny!"</p>
        <div class="reviewer">Emily R.</div>
      </div>
      <div class="review-card">
        <div class="rating">★★★★☆</div>
        <p>"Great experience so far! The speed and reliability are top-notch, though I’d love to see more integrations in the future."</p>
        <div class="reviewer">Michael P.</div>
      </div>
    </div>
  </section>
@endsection
