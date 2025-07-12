<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Only admin can access this content
    public function __construct()
    {
        $this->middleware(['auth', 'EnsureRole:admin']);
    }

    // Display the blogs in the admin dashboard
    public function index()
    {
        $blogs = Blog::latest()->paginate(10); // Changed to paginate for better UX views
        return view('admin.blogs.index', compact('blogs'));
    }

    // Show the form to create a new blog
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Store the new created blog
    public function store(Request $request)
    {
        // Validate the data before storing
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Blog::create($validated);
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }
    // Display a specific blog by ID (admin view)
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    // Show the form to edit a blog
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    // Update a blog
    public function update(Request $request, Blog $blog)
    {
        // Validate the blog
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        // Update validated blog
        $blog->update($validated);
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    // Delete a blog
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admindash')->with('success', 'Blog deleted successfully.');
    }
}
