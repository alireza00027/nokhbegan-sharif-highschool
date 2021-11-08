<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ScheduleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller {
    public function index() {
        $title = 'برنامه های هفتگی من';
        $schedules = Schedule::where('user_id', auth()->user()->id)->latest()->get();
        return view('app.schedules.index', compact('title', 'schedules'));
    }

    public function show(Schedule $schedule) {
        $title = 'برنامه هفتگی من';
        $requestScheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->where('type', 'request')->latest()->get();
        $answerScheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->where('type', 'answer')->latest()->get();
        $now = Carbon::now();
        $today = $now->format('l');
        return view('app.schedules.show', compact('title', 'requestScheduleItems', 'answerScheduleItems', 'today', 'schedule'));
    }
}
