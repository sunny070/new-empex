<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->cascade();
            $table->foreignId('state_id')->cascade();
            $table->foreignId('district_id')->cascade();
            $table->foreignId('police_station_id')->cascade();
            $table->foreignId('post_office_id')->cascade();
            $table->foreignId('rd_block_id')->cascade();
            $table->string('village');
            $table->string('pin_code');
            $table->string('house_no');
            $table->enum('status', ['Pending', 'Verified'])->default('Pending');
            $table->foreignId('user_district_id')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
