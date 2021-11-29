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
        $sumPoints = 0;
        $sumCoefficients = 0;
        $avg = 0;
        $roundedAvg = 0;
        if (count($exams) > 0) {
            foreach ($exams as $exam) {
                $sumPoints += ($exam->course->unit * $exam->point);
                $sumCoefficients += $exam->course->unit;
            }
            $avg = ($sumPoints / $sumCoefficients);
            $roundedAvg = round($avg, 2);
        }
        return view('app.exams.index', compact('title', 'exams', 'courses', 'roundedAvg'));
    }
}
