<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        $title = 'خانه';
        return view('app.home', compact('title'));
    }
}
