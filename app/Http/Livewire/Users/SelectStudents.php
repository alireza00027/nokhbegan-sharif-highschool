<?php

namespace App\Http\Livewire\Users;

use App\Models\Financial;
use App\Models\User;
use Livewire\Component;

class SelectStudents extends Component {

    public $students;
    public $grade;
    public $financialsUserId;
    public $selectedStudents;

    public function mount() {
        $this->grade = "seventh";
        $this->students = User::where('grade', '!=', 'teacher')->latest()->get();
        $this->selectedStudents = $this->students;
    }

    public function updatedGrade($value) {
        $this->selectedStudents = $this->students->where('grade', $value);
    }
    public function render() {
        return view('livewire.users.select-students');
    }
}
