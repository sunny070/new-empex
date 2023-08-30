<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('admins', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->string('email')->unique();
      $table->string('contact')->unique()->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->string('profile_photo_path', 2048)->nullable();
      // $table->string('aadhaar')->unique()->nullable();
      // $table->string('office_order')->nullable();
      $table->foreignId('role_id');
      $table->boolean('is_approved')->default(0);
      $table->foreignId('category_id')->nullable();
      $table->string('otp')->nullable();
      $table->boolean('active')->default(0); // active == 0 should provide details when login for the first time.
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
    Schema::dropIfExists('admins');
  }
}
