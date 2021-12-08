<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function changePassword(User $user) {
        $title = 'تعویض رمز عبور';
        return view('app.users.change-password', compact('title', 'user'));
    }
    public function changePasswordProcess(Request $request, User $user) {
        $this->validate($request, [
            'prevPassword' => 'required',
            'newPassword' => 'required|min:6',
            'reNewPassword' => 'required_with:newPassword|same:newPassword|min:6'
        ]);
        if (Hash::check($request->prevPassword, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->change_password = 1;
            $user->update();
            alert()->success('اطلاعات شما با موفقیت ثبت شد', 'عملیات موفق')->autoclose(3000);
            Auth::loginUsingId($user->id);
            return redirect()->route('home');
        } else {
            alert()->warning('رمز عبور وارد شده با رمز عبور فعلی مطابقت ندارد', 'عملیات ناموفق')->autoclose(3000);
            return redirect()->route('home');
        }
    }
    public function profile(User $user) {
        $title = 'اطلاعات کاربری';
        return view('app.users.profile', compact('user', 'title'));
    }
}
