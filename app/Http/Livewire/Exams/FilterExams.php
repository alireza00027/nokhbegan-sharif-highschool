<?php

namespace App\Http\Livewire\Exams;

use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class FilterExams extends Component
{

    public $grade;
    public $students;

    public function mount() {
        $this->students=User::all();
    }
    public function updatedGrade($value) {
        $this->students=User::whereGrade($value)->get();
    }
    public function render()
    {
        $courses=Course::all();
        return view('livewire.exams.filter-exams',compact('courses'));
    }
}
