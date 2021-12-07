<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function create() {
        $title = 'ایجاد کاربر جدید';
        return view('admin.students.create', compact('title'));
    }
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required|max:11|min:11',
            'natural_id' => 'required|max:10|min:10',
            'grade' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'natural_id' => $request->natural_id,
            'grade' => $request->grade,
            'password' => Hash::make($request->password)
        ]);
        alert()->success('عملیات موفق', 'کاربر با موفقیت ثبت شد');
        return back();
    }
    public function seventhList() {
        $title = "لیست دانش آموزان پایه هفتم";
        $students = User::where('grade', 'seventh')->latest()->get();
        return view('admin.students.seventh.index', compact('title', 'students'));
    }

    public function eighthList() {
        $title = "لیست دانش آموزان پایه هشتم";
        $students = User::where('grade', 'eighth')->latest()->get();
        return view('admin.students.eighth.index', compact('title', 'students'));
    }

    public function ninthList() {
        $title = "لیست دانش آموزان پایه نهم";
        $students = User::where('grade', 'ninth')->latest()->get();
        return view('admin.students.ninth.index', compact('title', 'students'));
    }

    public function teachers() {
        $title = 'لیست معلمین';
        $teachers = User::whereGrade('teacher')->latest()->get();
        return view('admin.teachers.index', compact('title', 'teachers'));
    }

    public function edit(User $user) {
        $title = "ویرایش دانش آموز";
        return view('admin.students.edit', compact('title', 'user'));
    }

    public function update(Request $request, User $user) {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required|max:11|min:11',
            'natural_id' => 'required|max:10|min:10',
            'grade' => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->natural_id = $request->natural_id;
        $user->grade = $request->grade;
        $user->update();
        return back();
    }

    public function delete(User $user) {
        $user->delete();
        return back();
    }
}
