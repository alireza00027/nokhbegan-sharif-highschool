<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('financial_id')->unsigned();
            $table->integer('amount')->nullable()->comment('مقدار قسط');
            $table->timestamp('paid_at')->comment('تاریخ پرداخت');
            $table->enum('status',['paying','paid'])->comment('وضعیت پرداخت');
            $table->date('date_pay')->comment('تاریخ فابل پرداخت');
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
        Schema::dropIfExists('financial_items');
    }
}
