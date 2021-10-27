<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('amount')->nullable()->comment('کل مبلغ پرداختی');
            $table->enum('grade',['seventh','eighth','ninth']);
            $table->integer('paid')->nullable()->comment('مقدار تا کنون پرداخت شده');
            $table->integer('n_items')->nullable()->comment('تعداد اقساط');
            $table->integer('n_paid_items')->nullable()->comment('تعداد اقساط پرداخت شده');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financials');
    }
}
