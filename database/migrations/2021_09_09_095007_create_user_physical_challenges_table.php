<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhysicalChallengesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_physical_challenges', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->cascade();
      $table->foreignId('physical_challenge_id')->cascade();
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
    Schema::dropIfExists('user_physical_challenges');
  }
}
