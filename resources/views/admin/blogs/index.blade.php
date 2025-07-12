@extends('admin.layout.dashboard')

@section('content')
    <div class="bg-gray-100 py-8 px-4 flex items-start justify-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full">
            <h1 class="text-3xl font-bold mb-8 text-center capitalize text-gray-500">Blog Lists</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-6">
                @forelse ($blogs as $blog)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300 ease-in-out">
                        <h2 class="font-semibold text-xl text-gray-800 capitalize tracking-tight mb-2">{{ $blog->title }}</h2>
                        <div class="mb-3">
                            <div class="text-gray-700 font-semibold text-sm uppercase">{{ $blog->author ?? 'Unknown' }}</div>
                            <div class="text-gray-500 text-sm font-light">{{ $blog->created_at->format('M d, Y') }}</div>
                        </div>
                        <a href="{{ route('blogs.edit', $blog) }}" class="inline-block text-blue-600 hover:text-blue-800 font-medium text-sm uppercase tracking-wide hover:underline transition duration-200">Edit</a>
                        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 mt-3 text-white px-4 py-1 rounded hover:bg-red-600 transition">Delete</button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 italic">
                        <p>No blogs available.</p>
                    </div>
                @endforelse
            </div>
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
