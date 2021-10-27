<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLevelController extends Controller
{
    public function index()
    {
        $title='سطح دسترسی';
        $roles=Role::with('users')->orderBy('id')->paginate(12);
        $teachers=User::whereGrade('teacher')->latest()->get();
        return view('admin.level.index',compact('title','roles','teachers'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required',
            'role_id'=>'required'
        ]);
        $user=User::find($request->user_id);
        $user->roles()->attach($request->role_id);
        return redirect()->route('admin.level.index');
    }
}
