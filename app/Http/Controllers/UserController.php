<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function profile() {
        $title = 'اطلاعات کاربری';
        $user = auth()->user();
        return view('app.users.profile', compact('user', 'title'));
    }

    public function changePassword(User $user, Request $request) {
    }

    public function update(User $user, Request $request) {
    }
}
