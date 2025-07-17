<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Choice;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AssignmentController extends Controller
{
    /**
     * Apply middleware to restrict access to authenticated admins only.
     */
    public function __construct()
    {
        // Ensure only authenticated users with role 'admin' can access these methods
        $this->middleware(['auth', 'EnsureRole:admin']);
    }

    /**
     * Display a list of all assignments in the admin dashboard.
     */
    public function index()
    {
        // Fetch all assignments (consider filtering by created_by for the current admin)
        $assignments = Assignment::where('create_by', Auth::id())->get();

        // Return the admin assignments index view, passing the assignments collection
        return view('admin.assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new assignment.
     *
     * @return \Illuminate\View\View The view for the assignment creation form.
     */
    public function create()
    {
        // Fetch approved students for assignment selection
        $students = User::where('role', 'user')->where('status', 'approved')->get();

        // Return the create assignment view, passing the students collection
        return view('admin.assignments.create', compact('students'));
    }

    /**
     * Store a newly created assignment in the database.
     */
    public function store(Request $request)
    {
        //inspect the incoming request data:
        Log::info($request->all());
    
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255', // Assignment title is required, max 255 characters
            'description' => 'nullable|string', // Description is optional
            'questions' => 'required|array|min:1', // At least one question is required
            'questions.*.question_text' => 'required|string', // Each question must have text
            'questions.*.correct_answer' => 'required|in:A,B,C', // Correct answer must be A, B, or C
            'questions.*.choices' => 'required|array|size:3', // Each question must have exactly 3 choices
            'questions.*.choices.*.option' => 'required|in:A,B,C', // Each choice option must be A, B, or C
            'questions.*.choices.*.option_text' => 'required|string', // Each choice must have text
            'students' => 'required|array|min:1', // At least one student must be assigned
        ]);

        // Create a new assignment with the validated data
        $assignment = Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'create_by' => Auth::id(), // Set the creator as the authenticated admin
        ]);

        // Create questions for the assignment
        foreach ($request->questions as $question) {
            $QnData = Question::create([
                'assignment_id' => $assignment->id,
                'question_text' => $question['question_text'],
                'correct_answer' => $question['correct_answer'],
                'marks' => 10, // Hardcoded marks for each question
            ]);

            // Create choices for each question
            foreach ($question['choices'] as $choice) {
                Choice::create([
                    'question_id' => $QnData->id,
                    'option' => $choice['option'],
                    'option_text' => $choice['option_text'],
                ]);
            }
        }

        // Attach students to the assignment via the assignment_student pivot table
        $assignment->students()->attach($request->students);

        // Redirect to the admin assignments index with a success message
        return redirect()->route('assignments.index')->with('success', 'Assignment created successfully');
    }

    /**
     * Show the form for editing an existing assignment.

     */
    public function edit(Assignment $assignment)
    {
        // Check if the user is authorized to edit the assignment (admin, approved, and creator)
        //$this->authorizeAssignment($assignment);

        // Fetch approved students for assignment selection
        $students = User::where('role', 'user')->where('status', 'approved')->get();

        // Return the edit view, passing the assignment and students data
        return view('admin.assignments.edit', compact('assignment', 'students'));
    }

    /**
     * Update an existing assignment in the database.
     *
     */
    public function update(Request $request, Assignment $assignment)
    {
        // Check if the user is authorized to update the assignment (admin, approved, and creator)
       // $this->authorizeAssignment($assignment);

        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255', // Assignment title is required, max 255 characters
            'description' => 'nullable|string', // Description is optional
            'questions' => 'required|array|min:1', // At least one question is required
            'questions.*.question_text' => 'required|string', // Each question must have text
            'questions.*.correct_answer' => 'required|in:A,B,C', // Correct answer must be A, B, or C
            'questions.*.choices' => 'required|array|size:3', // Each question must have exactly 3 choices
            'questions.*.choices.*.option' => 'required|in:A,B,C', // Each choice option must be A, B, or C
            'questions.*.choices.*.option_text' => 'required|string', // Each choice must have text
            'students' => 'required|array|min:1', // At least one student must be assigned
        ]);

        // Update the assignment's title and description
        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Delete existing questions to replace with new ones
        $assignment->questions()->delete();

        // Create new questions from the request data
        foreach ($request->questions as $qData) {
            $question = Question::create([
                'assignment_id' => $assignment->id,
                'question_text' => $qData['question_text'],
                'correct_answer' => $qData['correct_answer'],
                'marks' => 10, // Hardcoded marks for each question
            ]);

            // Create choices for the question
            foreach ($qData['choices'] as $choice) {
                Choice::create([
                    'question_id' => $question->id,
                    'option' => $choice['option'],
                    'option_text' => $choice['option_text'],
                ]);
            }
        }

        // Sync the assigned students (replaces existing assignments in assignment_student table)
        $assignment->students()->sync($request->students);

        // Redirect to the admin assignments index with a success message
        return redirect()->route('assignments.index')->with('success', 'Assignment updated.');
    }

    /**
     * Delete an assignment from the database.
     *
     */
    public function destroy(Assignment $assignment)
    {
        // Check if the user is authorized to delete the assignment
        //$this->authorizeAssignment($assignment);

        // Delete the assignment (cascades to questions and submissions if configured)
        $assignment->delete();

        // Redirect to the admin assignments index with a success message
        return redirect()->route('assignments.index')->with('success', 'Assignment deleted.');
    }

    /**
     * Assign students to an existing assignment.
     *
  
     */
    public function assignStudents(Request $request, Assignment $assignment)
    {
        // Check if the user is authorized to assign students
        $this->authorizeAssignment($assignment);

        // Validate the incoming student IDs
        $request->validate([
            'students' => 'required|array|min:1', // At least one student must be selected
        ]);

        // Sync the students in the assignment_student pivot table
        $assignment->students()->sync($request->students);

        // Redirect to the admin assignments index with a success message
        return redirect()->route('admin.assignments.index')->with('success', 'Students assigned.');
    }

    /**
     * Authorize the user to perform actions on an assignment.
     * Only admins who created the assignment and have approved status can proceed.
     */
    private function authorizeAssignment(Assignment $assignment)
    {
        // Check if the user is the creator, an admin, and approved
        if (
            $assignment->created_by !== Auth::id() ||
            strtolower(Auth::user()->role) !== 'admin' ||
            Auth::user()->status !== 'approved'
        ) {
            abort(403, 'Unauthorized action.');
        }
    }
}
