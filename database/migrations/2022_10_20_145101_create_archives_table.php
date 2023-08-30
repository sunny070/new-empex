<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->date('dob')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('parents_name')->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('society')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('employment_no')->nullable();
            $table->date('card_valid_from')->nullable();
            $table->date('card_valid_till')->nullable();
            $table->boolean('ex_servicemen')->default(0);
            $table->json('physical_challenge')->nullable();
            $table->json('languages')->nullable();
            $table->json('address')->nullable();
            $table->json('education')->nullable();
            $table->json('experience')->nullable();
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
        Schema::dropIfExists('archives');
    }
}
