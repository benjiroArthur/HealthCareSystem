<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('srn');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('other_name')->nullable();
            $table->string('email');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('specialization_id')->nullable();
            $table->string('qualification')->nullable();
            $table->string('image')->default('noimage.jpg');
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
        Schema::dropIfExists('doctors');
    }
}
