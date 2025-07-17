<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    // Fetch assignments assigned to the current user via the assignment_student pivot table

// public function index(){
//     $assignments = Auth::user()->assignments()->with('submissions')->get();
//         // Return the student assignments index view, passing the assignments collection
//         return view('user.submissions.index', compact('assignments'));
// }


}
