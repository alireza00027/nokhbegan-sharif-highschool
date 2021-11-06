<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleItemsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('schedule_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('schedule_id')->unsigned();
            $table->enum('type', ['request', 'answer']);
            $table->string('day_of_week')->nullable();
            $table->bigInteger('amount_today_lessons')->nullable();
            $table->bigInteger('amount_tomorow_lessons')->nullable();
            $table->bigInteger('amount_review_previous_lessons')->nullable();
            $table->bigInteger('home_work')->nullable();
            $table->bigInteger('sum_hour')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('schedule_items');
    }
}
