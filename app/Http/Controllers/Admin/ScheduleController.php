<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\ScheduleItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller {
    public $daysWeek = [
        'Saturday' => 'شنبه',
        'Sunday' => 'یکشنبه',
        'Monday' => 'دوشنبه',
        'Tuesday' => 'سه شنبه',
        'Wendsday' => 'چهارشنبه',
        'Thursday' => 'پنجشنبه',
        'Friday' => 'جمعه'
    ];
    public $months = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
    public function index() {
        $title = 'لیست برنامه های هفتگی';
        $schedules = Schedule::filter()->latest()->paginate(12);
        return view('admin.schedules.index', compact('title', 'schedules'));
    }
    public function create() {
        $title = 'ایجاد برنامه هفتگی';
        $daysWeek = $this->daysWeek;
        $months = $this->months;
        return view('admin.schedules.create', compact('title', 'daysWeek', 'months'));
    }
    public function store(Request $request) {
        $this->validate($request, [
            'student_id' => 'required',
            'createdAt' => 'required',
            'createdAtTimestamp' => 'required',
            'month' => 'required',
            'n_week' => 'required'
        ]);
        $schedule = new Schedule();
        $schedule->user_id = $request->student_id;
        $schedule->month = $request->month;
        $schedule->n_week = $request->n_week;
        $schedule->created_at = Carbon::createFromTimestamp($request->createdAtTimestamp);
        $schedule->updated_at = Carbon::createFromTimestamp($request->createdAtTimestamp);
        $schedule->save();
        $dayNumber = 0;
        foreach ($this->daysWeek as $key => $value) {
            $sumHourItem = 0;
            $requestScheduleItem = new ScheduleItem();
            $requestScheduleItem->day_of_week = $key;
            $requestScheduleItem->type = "request";
            $requestScheduleItem->schedule_id = $schedule->id;
            $requestScheduleItem->amount_today_lessons = $request->get('amount_today_lessons_' . $key);
            $sumHourItem += $request->get('amount_today_lessons_' . $key);
            $requestScheduleItem->amount_tomorow_lessons = $request->get('amount_tomorow_lessons_' . $key);
            $sumHourItem += $request->get('amount_tomorow_lessons_' . $key);
            $requestScheduleItem->amount_review_previous_lessons = $request->get('amount_review_previous_lessons_' . $key);
            $sumHourItem += $request->get('amount_review_previous_lessons_' . $key);
            $requestScheduleItem->home_work = $request->get('home_work_' . $key);
            $sumHourItem += $request->get('home_work_' . $key);
            $requestScheduleItem->description = $request->get('description_' . $key);

            $requestScheduleItem->sum_hour = $sumHourItem;
            $requestScheduleItem->created_at = Carbon::createFromTimestamp($request->createdAtTimestamp)->addDays($dayNumber);
            $requestScheduleItem->updated_at = Carbon::createFromTimestamp($request->createdAtTimestamp)->addDays($dayNumber);
            $requestScheduleItem->save();
            $schedule->sum_hour_request += $sumHourItem;
            $schedule->save();

            $answerScheduleItem = new ScheduleItem();
            $answerScheduleItem->day_of_week = $key;
            $answerScheduleItem->type = "answer";
            $answerScheduleItem->schedule_id = $schedule->id;
            $answerScheduleItem->created_at = Carbon::createFromTimestamp($request->createdAtTimestamp)->addDays($dayNumber);
            $answerScheduleItem->updated_at = Carbon::createFromTimestamp($request->createdAtTimestamp)->addDays($dayNumber);
            $answerScheduleItem->save();

            $dayNumber++;
        }
        alert()->success('عملیات موفق', 'عملیات با موفقیت انجام شد')->autoclose(4000);
        return redirect()->route('admin.schedules.show', ['schedule' => $schedule->id]);
    }

    public function show(Request $request, Schedule $schedule) {
        $title = 'مشاهده برنامه هفتگی';
        $user = $schedule->user;
        $requestScheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->where('type', 'request')->orderBy('created_at')->get();
        $answerScheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->where('type', 'answer')->orderBy('created_at')->get();
        return view('admin.schedules.show', compact('title', 'requestScheduleItems', 'answerScheduleItems', 'user', 'schedule'));
    }

    public function process(Request $request, Schedule $schedule) {
        $scheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->where('type', 'request')->latest()->get();
        $sumHour = 0;
        foreach ($scheduleItems as $scheduleItem) {
            $sumHourItem = 0;
            $scheduleItem->amount_today_lessons = $request->get('request_amount_today_lessons_' . $scheduleItem->day_of_week);
            $sumHourItem += $request->get('request_amount_today_lessons_' . $scheduleItem->day_of_week);
            $scheduleItem->amount_tomorow_lessons = $request->get('request_amount_tomorow_lessons_' . $scheduleItem->day_of_week);
            $sumHourItem += $request->get('request_amount_tomorow_lessons_' . $scheduleItem->day_of_week);
            $scheduleItem->amount_review_previous_lessons = $request->get('request_amount_review_previous_lessons_' . $scheduleItem->day_of_week);
            $sumHourItem += $request->get('request_amount_review_previous_lessons_' . $scheduleItem->day_of_week);
            $scheduleItem->home_work = $request->get('request_home_work_' . $scheduleItem->day_of_week);
            $sumHourItem += $request->get('request_home_work_' . $scheduleItem->day_of_week);

            $scheduleItem->description = $request->get('request_description_' . $scheduleItem->day_of_week);

            $scheduleItem->sum_hour = $sumHourItem;
            $scheduleItem->save();
            $sumHour += $sumHourItem;
        }
        $schedule->sum_hour_request = $sumHour;
        $schedule->save();
        alert()->success('عملیات موفق', 'تغیرات با موفقیت اعمال شد')->autoclose(4000);
        return back();
    }

    public function destroy(Schedule $schedule) {
        $scheduleItems = ScheduleItem::where('schedule_id', $schedule->id)->get();
        foreach ($scheduleItems as $item) {
            $item->delete();
        }
        $schedule->delete();
        alert()->success('عملیات موفق', 'حذف با موفقیت انجام شد')->autoclose(4000);
        return back();
    }
}
