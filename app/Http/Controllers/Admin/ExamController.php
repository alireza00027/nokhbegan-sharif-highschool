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
        $title = "لیست آزمون ها";
        $exams = Exam::filter()->with('user')->with('course')->latest()->paginate(30);
        return view('admin.exams.index', compact('title', 'exams'));
    }

    public function chartStyle() {
        $title = 'تحلیل نموداری';
        $exams = Exam::selectRaw('PDATE(created_at) day , point ,user_id')
            ->filter()
            ->where('created_at', '>', Carbon::now()->subMonth(6))
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($exams as $exam) {
            $user = User::where('id', $exam->user_id)->first();
            $exam->userName = $user->name;
        }
        return view('admin.exams.chart-style', compact('title', 'exams'));
    }

    public function create() {
        $title = "ثبت آزمون صبحانه";
        $courses = Course::all();
        return view('admin.exams.create', compact('title'));
    }

    public function store(Request $request) {
        $studentsId = User::where('grade', $request->grade)->pluck('id')->toArray();
        foreach ($studentsId as $id) {
            $exam = new Exam();
            $exam->user_id = $id;
            $exam->course_id = $request->course_id;
            $exam->point = $request->get('point_' . $id);
            $exam->created_at = Carbon::createFromTimestamp($request->createdAtTimestamp);
            $exam->updated_at = Carbon::createFromTimestamp($request->createdAtTimestamp);
            $exam->save();
        }
        alert()->success('عملیات با موفقیت انجام شد', 'عملیات موفق')->autoclose(4000);
        return back();
    }
}
