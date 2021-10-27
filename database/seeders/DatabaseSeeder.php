<?php

namespace Database\Seeders;

use Database\Factories\ExamFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        \App\Models\User::factory(40)->create();
        //\App\Models\Exam::factory(100)->create();
    }
}
