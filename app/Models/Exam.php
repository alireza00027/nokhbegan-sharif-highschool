<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use App\Models\User;

class Exam extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'point',
        'created_at',
        'updated_at'
    ];
    //relationShip
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }
    //methods
    public function getStatus() {
        $status = ['bg' => 'unknow', 'str' => 'مشخص نشده'];
        if ($this->point >= 0 and $this->point <= 0.5) {
            $status = ['bg' => 'veryBad', 'str' => 'بد'];
        } elseif ($this->point > 0.5 and $this->point <= 1.0) {
            $status = ['bg' => 'bad', 'str' => 'متوسط'];
        } elseif ($this->point > 1.0 and $this->point <= 1.5) {
            $status = ['bg' => 'middle', 'str' => 'خوب'];
        } elseif ($this->point > 1.5 and $this->point <= 2) {
            $status = ['bg' => 'good', 'str' => 'عالی'];
        }
        return $status;
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
        $courseId = request('course_id');
        $grade = request('grade');


        if (isset($grade) && trim($grade) != '' && $grade != "all") {
            $query->whereHas('user', function ($query) use ($grade) {
                $query->where('grade', $grade);
            });
        }

        if (isset($courseId) && trim($courseId) != '' && $courseId != "all") {
            $query->where('course_id', $courseId);
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
