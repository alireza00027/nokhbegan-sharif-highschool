<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller {

    public function index() {
        $title = "لیست امتحانات 1";
        $exams = Exam::filter()->with('user')->with('course')->latest()->paginate(30);
        return view('admin.exams.index', compact('title', 'exams'));
    }

    public function chartStyle() {
        $title = 'تحلیل نموداری';
        $exams = Exam::selectRaw('PDATE(created_at) day , point')
            ->filter()
            ->where('created_at', '>', Carbon::now()->subMonth(6))
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.exams.chart-style', compact('title', 'exams'));
    }

    public function create() {
        $title = "ثبت آزمون صبحانه";
        return view('admin.exams.create', compact('title'));
    }

    public function store(Request $request) {
        dd($request);
    }
}
