<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller {
    public function index() {
        $title = 'آزمون های من';
        $courses = Course::all();
        $exams = Exam::where('user_id', auth()->user()->id)->filter()->with('course')->latest()->paginate(12);
        return view('app.exams.index', compact('title', 'exams', 'courses'));
    }
}
