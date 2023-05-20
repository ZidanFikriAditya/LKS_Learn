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
        Schema::create('societies', function (Blueprint $table) {
            $table->id();
            $table->char('id_card_number', 8)->unique();
            $table->string('password');
            $table->string('name');
            $table->date('born_date');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('regional_id');
            $table->foreign('regional_id')->references('id')->on('regionals')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->text('login_tokens')->nullable();
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
        Schema::dropIfExists('societies');
    }
};
