<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $enrolments = Enrolment::where('student_id', auth()->id())
            ->with(['course', 'grades', 'course.instructor'])
            ->get();

        return view('student.progress.index', compact('enrolments'));
    }
}
