<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UserController;
use Closure;
use Illuminate\Http\Request;

class changePassword {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (auth()->user()->change_password == 0) {
            alert()->warning('اخطار', 'قبل از استفاده از سامانه ابتدا باید رمز عبور خود را تغییر دهید')->autoclose(4000);
            return redirect()->route('users.changePassword', ['user' => auth()->user()->id]);
        }
        return $next($request);
    }
}
