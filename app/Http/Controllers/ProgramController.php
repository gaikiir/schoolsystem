<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of programs for the frontend.
     *
     * @return \Illuminate\View\View
     */
    public function showFrontendPrograms()
    {
        $programs = Program::paginate(6);
        return view('programs', compact('programs'));
    }
}
