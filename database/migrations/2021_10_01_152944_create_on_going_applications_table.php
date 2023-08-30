<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnGoingApplicationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('on_going_applications', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id');
      $table->string('type'); // New Application, Renewal, Surrender, Change request - (Basic info, Education details, Address, Experiences, Transfer)
      $table->string('model_name');
      $table->foreignId('requested_id')->nullable();
      $table->date('verified_date')->nullable();
      $table->date('rejected_date')->nullable();
      $table->string('status'); // Pending, Verified, Rejected (approved chuan DB atang delete tur)
      $table->string('rejection_note')->nullable();
      $table->string('color')->nullable(); // new = #2d9735, change = #ff7e0e, renew = #2072ff, surrender = #f8295a
      $table->string('bg')->nullable(); // new = #e1ffe3, change = #fff5ef, renew = #eff5ff, surrender = #ffe1eb
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
    Schema::dropIfExists('on_going_applications');
  }
}
