<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_date')->nullable();
            $table->integer('amount_spent')->nullable();
            $table->string('receipt_no')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('expense_type_id')->nullable();
            $table->foreign("expense_type_id")->references('id')->on('expense_types')->cascadeOnDelete()->onUpdate("CASCADE");
            $table->integer('added_by');
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
        Schema::dropIfExists('expenses');
    }
}
