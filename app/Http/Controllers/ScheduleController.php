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
        $requestScheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->where('type', 'request')->orderBy('created_at')->get();
        $answerScheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->where('type', 'answer')->orderBy('created_at')->get();
        $today = Carbon::now();
        $todayName = $today->format('l');
        return view('app.schedules.show', compact('title', 'requestScheduleItems', 'answerScheduleItems', 'today', 'todayName', 'schedule'));
    }

    public function process(Schedule $schedule, Request $request) {
        $now = Carbon::now();
        $today = $now->toFormattedDateString();
        $todayName = $now->format('l');
        $answerScheduleItem = ScheduleItem::where('schedule_id', $schedule->id)->where('type', "answer")->where('day_of_week', $todayName)->first();
        if (($answerScheduleItem->created_at)->toFormattedDateString() == $today) {
            $sumHour = 0;
            $oldSumHourSchedule =  ($answerScheduleItem->sum_hour);
            $answerScheduleItem->amount_today_lessons = $request->get('answer_amount_today_lessons_' . $answerScheduleItem->day_of_week);
            $sumHour += $request->get('answer_amount_today_lessons_' . $answerScheduleItem->day_of_week);
            $answerScheduleItem->amount_tomorow_lessons = $request->get('answer_amount_tomorow_lessons_' . $answerScheduleItem->day_of_week);
            $sumHour += $request->get('answer_amount_tomorow_lessons_' . $answerScheduleItem->day_of_week);
            $answerScheduleItem->amount_review_previous_lessons = $request->get('answer_amount_review_previous_lessons_' . $answerScheduleItem->day_of_week);
            $sumHour += $request->get('answer_amount_review_previous_lessons_' . $answerScheduleItem->day_of_week);
            $answerScheduleItem->home_work = $request->get('answer_home_work_' . $answerScheduleItem->day_of_week);
            $sumHour += $request->get('answer_home_work_' . $answerScheduleItem->day_of_week);
            $answerScheduleItem->sum_hour = $sumHour;
            $answerScheduleItem->save();
            $schedule->sum_hour_answer -= $oldSumHourSchedule;
            $schedule->save();
            $schedule->sum_hour_answer += $sumHour;
            $schedule->save();
            alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد')->autoclose(4000);
            return back();
        } else {
            alert()->error('عملیات ناموفق', 'فیلد های پر شده مربوط به امروز نیست');
            return back();
        }
    }
}
