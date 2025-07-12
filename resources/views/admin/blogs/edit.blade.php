@extends('admin.layout.dashboard')

@section('content')
    <div class="flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit your blog here</h1>
        <form action="{{route('blogs.update',$blog)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Blog Title</label>
                <input type="text" id="title" value="{{ $blog->title }}" name="title" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            </div>
            <div class="mb-4">
                <label for="blogger_name" class="block text-sm font-medium text-gray-700">Blogger's Name</label>
                <input type="text" id="blogger_name" value="{{ $blog->author }}" name="author" value="" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('author')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            </div>
            {{-- <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div> --}}
            <div class="mb-4">
                <label for="blog_text" class="block text-sm font-medium text-gray-700">Blog Content</label>
                <textarea id="blog_text" name="description" rows="10" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{old('description',$blog->description)}}</textarea>
                @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit"  class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update</button>
            </div>
        </form/>
    </div>
</div>
@endsection