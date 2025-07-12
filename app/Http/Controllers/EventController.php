<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display all blogs on the frontend
    public function showFrontendEvents()
    {
        $events = Event::all();
        return view('events', compact('events'));
    }

    // Display a specific blog on the frontend
    public function show(string $id)
    {
        $events = Event::findOrFail($id);
        //return view('events', compact('blog'));
    }
}
