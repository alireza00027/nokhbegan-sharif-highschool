<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function seventhList() {
        $title="لیست دانش آموزان پایه هفتم";
        $students=User::where('grade','seventh')->latest()->paginate(12);
        return view('admin.students.seventh.index',compact('title','students'));
    }

    public function eighthList() {
        $title="لیست دانش آموزان پایه هشتم";
        $students=User::where('grade','eighth')->latest()->paginate(12);
        return view('admin.students.eighth.index',compact('title','students'));
    }

    public function ninthList() {
        $title="لیست دانش آموزان پایه نهم";
        $students=User::where('grade','ninth')->latest()->paginate(12);
        return view('admin.students.ninth.index',compact('title','students'));
    }

    public function teachers()
    {
        $title='لیست معلمین';
        $teachers=User::whereGrade('teacher')->latest()->paginate(12);
        return view('admin.teachers.index',compact('title','teachers'));
    }

    public function edit(User $user) {
        $title="ویرایش دانش آموز";
        return view('admin.students.edit',compact('title','user'));
    }

    public function update(Request $request , User $user) {
        $user->name=$request->name;
        $user->email=$request->email;
        $user->mobile=$request->mobile;
        $user->natural_id=$request->natural_id;
        $user->grade=$request->grade;
        $user->update();
        return back();
    }

    public function delete(User $user) {
        $user->delete();
        return back();
    }
}
