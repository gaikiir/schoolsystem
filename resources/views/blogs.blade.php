@extends('layouts.frontend')

@section('content')
<section class="w-full">
        <h1 class="text-3xl text-center font-bold capitalize py-4">Blogs</h1>
    <div class="mt-5 gap-4 grid grid-cols-1 md:grid-cols-4 px-4 sm:px-6 lg:px-8">
        @forelse ($blogs as $blog)
            <div class=" shadow-lg p-6 bg-white rounded-lg">
                <h2 class="font-semibold text-2xl text-gray-800 capitalize tracking-tight mb-2">{{ $blog->title }}</h2>
                        <div class="reviewer mt-2 font-semibold text-gray-700 uppercase text-sm">{{ $blog->author }}</div>
                    <p class="text-gray-600 font-medium text-base leading-relaxed italic mb-3">"{{ $blog->description }}"</p>
                <span class="text-blue-gray-500 text-sm font-light">{{ $blog->created_at }}</span>
                    <div class="rating mt-1 text-yellow-400 text-lg">★★★★★</div>
            </div>
            @empty
            <h5 class="no-blogs text-center shadow p-5 text-gray-500 text-lg font-medium mt-4">
                No blogs found
            </h5>
        @endforelse     
    </div>
</section>

@endsection