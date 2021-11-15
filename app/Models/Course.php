<?php

namespace App\Models;

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    use HasFactory;

    protected $fillable = ['title', 'unit'];


    public function exams() {
        return $this->hasMany(Exam::class, 'course_id');
    }

    public function getDate() {
        $v = Verta::instance($this->created_at);
        return $v->format('%B %d، %Y');
    }
}
