<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('addresses', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->cascade();
      $table->foreignId('state_id')->nullable()->cascade();
      $table->foreignId('district_id')->nullable()->cascade();
      $table->foreignId('police_station_id')->nullable()->cascade();
      $table->foreignId('post_office_id')->nullable()->cascade();
      $table->foreignId('rd_block_id')->nullable()->cascade();
      $table->string('village');
      $table->string('pin_code');
      $table->string('house_no');
      $table->boolean('same_as_permanent')->default(0);
      $table->enum('type', ['permanent', 'present']);
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
    Schema::dropIfExists('addresses');
  }
}
