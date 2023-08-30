<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->cascade()->nullable();
            $table->mediumText('recruiter_name')->nullable();
            $table->mediumText('employment_no')->nullable();
            $table->mediumText('designation')->nullable();
            $table->enum('type',['Temporary','Regular'])->nullable();
            $table->foreignId('district_id')->nullable();
            $table->date('recruit_date')->nullable();
            $table->mediumText('address')->nullable();
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
        Schema::dropIfExists('placements');
    }
}
