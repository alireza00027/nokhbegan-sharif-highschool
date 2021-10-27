<?php

namespace App\Http\Livewire\Exams;

use App\Models\User;
use Livewire\Component;

class AnalysisPoint extends Component
{

    public  $student;
    public $point=0;
    public $status=['text'=>'نامشخص','color'=>'info'];

    public function mount(User $student)
    {
        $this->student=$student;
    }

    public function updatedPoint($value) {
        if($value>=0 and $value<0.5){
            $this->status=[
                'text'=>'ضعیف',
                'color'=>'danger'
            ];
        }elseif($value>=0.5 && $value<1) {
            $this->status=[
                'text'=>'متوسط',
                'color'=>'warrning'
            ];
        }elseif($value>=1 && $value<1.5) {
            $this->status=[
                'text'=>'خوب',
                'color'=>'primary'
            ];
        }elseif($value>=1.5 && $value<2) {
            $this->status=[
                'text'=>'عالی',
                'color'=>'success'
            ];
        }
    }
    public function render()
    {
        return view('livewire.exams.analysis-point');
    }

}
