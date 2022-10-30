<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calfs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('tag_no')->nullable();
            $table->unsignedBigInteger('cattle_id')->nullable();
            $table->foreign("cattle_id")->references('id')->on('cattle')->cascadeOnDelete()->onUpdate("CASCADE");
            $table->string('weight')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('cattle_image')->nullable();
            $table->text('description')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->unsignedBigInteger('cattle_breed_id')->nullable();
            $table->foreign("cattle_breed_id")->references('id')->on('cattle_breeds')->cascadeOnDelete()->onUpdate("CASCADE");
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
        Schema::dropIfExists('calfs');
    }
}
