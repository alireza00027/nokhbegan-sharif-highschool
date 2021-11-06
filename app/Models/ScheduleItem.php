<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model {
    use HasFactory;

    protected $fillable = ['schedule_id', 'day_of_week', 'amount_today_lessons', 'amount_tomorow_lessons', 'amount_review_previous_lessons', 'home_work', 'sum_work'];

    public function getDayOfWeekText() {
        switch ($this->day_of_week) {
            case 'saturday':
                return "شنبه";
                break;
            case 'sunday':
                return "یکشنبه";
                break;
            case 'monday':
                return "دوشنبه";
                break;
            case 'tuesday':
                return "سه شنبه";
                break;
            case 'wendsday':
                return "چهارشنبه";
                break;
            case 'thursday':
                return "پنجشنبه";
                break;
            case 'friday':
                return "جمعه";
                break;

            default:
                return "مشخص نشده";
                break;
        }
    }
}
