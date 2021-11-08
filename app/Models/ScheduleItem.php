<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model {
    use HasFactory;

    protected $fillable = ['schedule_id', 'day_of_week', 'amount_today_lessons', 'amount_tomorow_lessons', 'amount_review_previous_lessons', 'home_work', 'sum_work'];

    public function getDayOfWeekText() {
        switch ($this->day_of_week) {
            case 'Saturday':
                return "شنبه";
                break;
            case 'Sunday':
                return "یکشنبه";
                break;
            case 'Monday':
                return "دوشنبه";
                break;
            case 'Tuesday':
                return "سه شنبه";
                break;
            case 'Wendsday':
                return "چهارشنبه";
                break;
            case 'Thursday':
                return "پنجشنبه";
                break;
            case 'Friday':
                return "جمعه";
                break;

            default:
                return "مشخص نشده";
                break;
        }
    }
}
