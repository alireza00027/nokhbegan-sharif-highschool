<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller {
    public function index() {
        $title = 'برنامه های هفتگی من';
        $schedules = Schedule::where('user_id', auth()->user()->id)->latest()->get();
        return view('app.schedules.index', compact('title', 'schedules'));
    }
}
