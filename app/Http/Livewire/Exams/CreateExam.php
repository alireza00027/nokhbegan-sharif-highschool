<?php

namespace App\Http\Livewire\Exams;

use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class CreateExam extends Component
{
    public $students;
    public $courseId=1;
    public $courseTitle='';
    public $grade;
    /**
     * when create exam load.
     */
    public function mount()
    {
        $this->students=User::whereGrade('seventh')->orderBy('name')->get();
        $course=Course::find($this->courseId);
        $this->courseTitle=$course->title;
    }
    public function updatedGrade($value) {
        $this->students=User::whereGrade($value)->orderBy('name')->get();
    }
    public function updatedCourseId($value) {
        $course=Course::find($value);
        $this->courseTitle=$course->title;
    }
    public function render()
    {
        $courses=Course::all();
        return view('livewire.exams.create-exam',compact('courses'));
    }

    // public function getStudents()
    // {
    //     $this->students=User::whereGrade($this->grade)->orderBy('name')->get();
    //     $course=Course::whereId($this->courseId)->first();
    //     $this->courseTitle=$course->title;

    // }

}
