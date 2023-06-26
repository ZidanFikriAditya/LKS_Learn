<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('dose');
            $table->date('date');
            $table->unsignedBigInteger('society_id');
            $table->foreign('society_id')->references('id')->on('societies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('spot_id');
            $table->foreign('spot_id')->references('id')->on('spots')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('medicals')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('officer_id');
            $table->foreign('officer_id')->references('id')->on('medicals')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('vaccinations');
    }
};
