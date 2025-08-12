<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
class ProgramController extends Controller
{
// Only admin can access this content
    public function __construct()
    {
        $this->middleware(['auth', 'EnsureRole:admin']);
    }
    //display program in dashboard 
    public function index(){
        $programs = Program::paginate(6);
        return view('admin.programs.index', compact('programs'));
    }
    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'mode' => 'required|string',
            'level' => 'required|string',
        ]);

        $program = Program::create($validated);
        // Flash success message with title and creation time
        return redirect()->route('admin.admin.dashboard')->with('program_notification', [
            'title' => $program->title,
            'created_at' => $program->created_at->format('Y-m-d H:i:s'),
        ]);
    
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'mode' => 'required|string',
            'level' => 'required|string',
        ]);

        $program = Program::create($validated);
        // Flash success message with title and creation time
        return redirect()->route('admin.admin.dashboard')->with('program_notification', [
            'title' => $program->title,
            'created_at' => $program->created_at->format('Y-m-d H:i:s'),
        ]);
    }
    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }

}
