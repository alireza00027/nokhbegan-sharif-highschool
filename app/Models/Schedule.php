<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;

class Schedule extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'sum_work_request', 'sum_work_answer', 'month', 'n_week'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNumberWeek() {
        switch ($this->n_week) {
            case '1':
                return "اول";
                break;
            case '2':
                return "دوم";
                break;
            case '3':
                return "سوم";
                break;
            case '4':
                return "چهارم";
                break;

            default:
                return "مشخص نشده";
                break;
        }
    }

    public function getTime() {
        $v = Verta::instance($this->created_at);
        return $v->format('%B %d، %Y');
    }

    //scops
    public function scopeFilter($query) {

        $fromDateTimestamp = request('fromDateTimestamp');
        $toDateTimestamp = request('toDateTimestamp');
        if (isset($fromDateTimestamp) || isset($toDateTimestamp)) {
            $fromDate = Carbon::createFromTimestamp($fromDateTimestamp);
            $toDate = Carbon::createFromTimestamp($toDateTimestamp);
        }

        $studentId = request('student_id');
        $grade = request('grade');


        if (isset($grade) && trim($grade) != '' && $grade != "all") {
            $query->whereHas('user', function ($query) use ($grade) {
                $query->where('grade', $grade);
            });
        }

        if (isset($studentId) && trim($studentId) != '' && $studentId != "all") {
            $query->where('user_id', $studentId);
        }

        if (isset($fromDateTimestamp) && trim($fromDateTimestamp) != "") {
            $query->where('created_at', '>=', $fromDate->toDateString());
        }

        if (isset($toDateTimestamp) && trim($toDateTimestamp) != "") {
            $query->where('created_at', '<=', $toDate->toDateString());
        }

        return $query;
    }
}
