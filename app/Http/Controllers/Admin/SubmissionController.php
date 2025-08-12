<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display submitted and pending assignments.
     */

    public function index()
    {
        // Get pending submissions (not submitted) with pagination
        $pending = AssignmentSubmission::with(['assignment', 'user'])
            ->where('is_submitted', false)
            ->latest()
            ->paginate(3);

        // Get submitted assignments with pagination
        $submitted = AssignmentSubmission::with(['assignment', 'user'])
            ->where('is_submitted', true)
            ->latest()
            ->paginate(3);

        return view('admin.submissions.index', compact('pending', 'submitted'));
    }

    /**
     * Display report for a specific assignment.
     */
    public function report(Assignment $assignment)
    {
        // Fetch submissions for the assignment
        $submissions = AssignmentSubmission::where('assignment_id', $assignment->id)
            ->with('user')
            ->get();
        return view('admin.submissions.report', compact('assignment', 'submissions'));
    }
}
