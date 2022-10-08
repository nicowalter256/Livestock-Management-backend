<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInserminatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inserminates', function (Blueprint $table) {
            $table->id();
            $table->string('insemination_date')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('cattle_id')->nullable();
            $table->foreign("cattle_id")->references('id')->on('cattle')->cascadeOnDelete()->onUpdate("CASCADE");
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
        Schema::dropIfExists('inserminates');
    }
}
