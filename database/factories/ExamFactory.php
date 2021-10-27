<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>rand(1,20),
            'course_id'=>rand(1,4),
            'point'=>rand(0,2),
            'created_at'=>$this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
            'updated_at'=>$this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        ];
    }
}
