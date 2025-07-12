<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    // Only admin can access this content
    public function __construct()
    {
        $this->middleware(['auth', 'EnsureRole:admin']);
    }
    //display events in the admindashboard
    public function index(){
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }
    //show form to create a new event
    public function create(){
        return view('admin.events.create');
    }

    //store the new created events

    public function store(Request $request){
        //validate the form data input before storing
        $isValidated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        //create the validated data
        Event::create($isValidated);
        return redirect()->route('events.index')->with('success', 'Blog created successfully.');
    }
    //show the edited form in admin dash for edit
    public function edit(string $id){
         $events = Event::findOrFail($id);
         return view('admin.events.edit', compact('events'));
    }
    //update the edited form
    public function update(Request $request, string $id){
        //validate the form
         $isValidated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $event = Event::findOrFail($id);
        $event->update($isValidated);
         return redirect()->route('events.index')->with('success', 'Event updated successfully!');

    }

    //delete the event

    public function destroy(string $id){
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admindash')->with('success', 'Event deleted successfully!');
    }
}
