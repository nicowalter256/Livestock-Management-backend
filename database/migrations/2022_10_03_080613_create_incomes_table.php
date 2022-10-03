<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('income_date')->nullable();
            $table->integer('amount_earned')->nullable();
            $table->string('receipt_no')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('income_type_id')->nullable();
            $table->foreign("income_type_id")->references('id')->on('income_types')->cascadeOnDelete()->onUpdate("CASCADE");
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
        Schema::dropIfExists('incomes');
    }
}
