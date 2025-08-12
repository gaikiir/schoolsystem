<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Question;
use App\Models\User;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of assignments.
     */
    public function index()
    {
        // Fetch all assignments with their questions
        $assignments = Assignment::with('questions')->paginate(3);
        return view('admin.assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new assignment.
     */
    public function create()
    {
        // Fetch only approved students
        $students = User::where('role', 'student')->where('status', 'approved')->get();
        return view('admin.assignments.create', compact('students'));
    }

    /**
     * Store a newly created assignment and its questions.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_marks' => 'required|integer|min:1',
            'deduction_per_wrong_answer' => 'required|integer|min:0',
            'students' => 'required|array|min:1',
            'students.*' => 'exists:users,id,role,student,status,approved', // Restrict to approved students            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.correct_option' => 'required|in:A,B,C',
            'questions.*.marks' => 'required|integer|min:1',
        ]);

        // Create the assignment
        $assignment = Assignment::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'total_marks' => $validated['total_marks'],
            'deduction_per_wrong_answer' => $validated['deduction_per_wrong_answer'],
        ]);

        // Create questions
        foreach ($validated['questions'] as $questionData) {
            Question::create([
                'assignment_id' => $assignment->id,
                'question_text' => $questionData['question_text'],
                'option_a' => $questionData['option_a'],
                'option_b' => $questionData['option_b'],
                'option_c' => $questionData['option_c'],
                'correct_option' => $questionData['correct_option'],
                'marks' => $questionData['marks'],
            ]);
        }

        // Assign to selected students
        foreach ($validated['students'] as $studentId) {
            $assignment->submissions()->create([
                'user_id' => $studentId,
                'answers' => [],
                'is_submitted' => false,
            ]);
        }

        return redirect()->route('admin.admin.assignments.index')->with('success', 'Assignment created successfully.');
    }

    /**
     * Show the form for editing an assignment.
     */
    public function edit(Assignment $assignment)
    {
        // Fetch students and questions for editing
        $students = User::where('role', 'student')->where('status', 'approved')->get();
        $assignment->load('questions', 'submissions');
        $selectedStudents = $assignment->submissions->pluck('user_id')->toArray();
        return view('admin.assignments.edit', compact('assignment', 'students', 'selectedStudents'));
    }

    /**
     * Update the specified assignment.
     */
    public function update(Request $request, Assignment $assignment)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_marks' => 'required|integer|min:1',
            'deduction_per_wrong_answer' => 'required|integer|min:0',
            'students' => 'required|array|min:1',
            'students.*' => 'exists:users,id,role,student,status,approved', // Restrict to approved students            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.correct_option' => 'required|in:A,B,C',
            'questions.*.marks' => 'required|integer|min:1',
        ]);

        // Update assignment
        $assignment->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'total_marks' => $validated['total_marks'],
            'deduction_per_wrong_answer' => $validated['deduction_per_wrong_answer'],
        ]);

        // Delete existing questions and recreate
        $assignment->questions()->delete();
        foreach ($validated['questions'] as $questionData) {
            Question::create([
                'assignment_id' => $assignment->id,
                'question_text' => $questionData['question_text'],
                'option_a' => $questionData['option_a'],
                'option_b' => $questionData['option_b'],
                'option_c' => $questionData['option_c'],
                'correct_option' => $questionData['correct_option'],
                'marks' => $questionData['marks'],
            ]);
        }

        // Update assigned students
        $assignment->submissions()->delete();
        foreach ($validated['students'] as $studentId) {
            $assignment->submissions()->create([
                'user_id' => $studentId,
                'answers' => [],
                'is_submitted' => false,
            ]);
        }

        return redirect()->route('admin.assignments.index')->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified assignment.
     */
    public function destroy(Assignment $assignment)
    {
        // Delete assignment and its related questions/submissions
        $assignment->delete();
        return redirect()->route('admin.assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}
