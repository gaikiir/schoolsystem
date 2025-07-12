<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    // Display all blogs on the frontend
    public function showFrontendBlogs()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('blogs', compact('blogs'));
    }

    // Display a specific blog on the frontend
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }
}
