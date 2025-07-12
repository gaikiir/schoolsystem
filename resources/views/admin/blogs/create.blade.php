@extends('admin.layout.dashboard')

@section('content')
<div class="flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Create a Blog Post</h1>
        <form action="{{route('blogs.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Blog Title</label>
                <input type="text" id="title" name="title" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="blogger_name" class="block text-sm font-medium text-gray-700">Blogger's Name</label>
                <input type="text" id="blogger_name" name="author" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            {{-- <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div> --}}
            <div class="mb-4">
                <label for="blog_text" class="block text-sm font-medium text-gray-700">Blog Content</label>
                <textarea id="blog_text" name="description" rows="10" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit"  class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Submit Post</button>
            </div>
        </form/>
    </div>

@endsection
