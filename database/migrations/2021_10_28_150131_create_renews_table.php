<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('active_from');
            $table->date('active_till');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->string('notes')->nullable();
            $table->date('new_active_from')->nullable();
            $table->date('new_active_till')->nullable();
            $table->string('aadhar_no')->nullable(); // this is for statistics in main page
            $table->enum('gender', ['Male', 'Female', 'Others']); // this is for statistics in main page
            $table->foreignId('district_id')->nullable();
            $table->string('name')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('renews');
    }
}
