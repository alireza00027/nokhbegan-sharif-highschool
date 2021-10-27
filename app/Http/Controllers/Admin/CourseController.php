<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $title="لیست دروس";
        $courses=Course::latest()->paginate(15);
        return view('admin.courses.index',compact('courses','title'));
    }

    public function store(Request $request) {
        $this->validate($request,[
            'title'=>'required'
        ]);
        $course=new Course();
        $course->title=$request->title;
        $course->save();
        return back();
    }

    public function update(Request $request , Course $course) {
        $this->validate($request,[
            'title'=>'required'
        ]);
        $course->update(['title'=>$request->title]);
        return back();
    }

    public function delete(Course $course) {
        $course->delete();
        return back();
    }
}
