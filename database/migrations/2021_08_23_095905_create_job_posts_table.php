<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('job_posts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('category_id')->nullable();
      $table->foreignId('type_id');
      $table->foreignId('sector_id')->nullable();
      $table->string('title');
      $table->string('slug')->nullable();
      $table->longText('description');
      $table->string('no_of_post');
      $table->date('due_date_of_submission');
      $table->string('organization_name')->nullable();
      $table->foreignId('department_id')->nullable();
      $table->foreignId('created_by')->nullable(); // ref: admin_id (creator)
      $table->boolean('published')->default(0);
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
    Schema::dropIfExists('job_posts');
  }
}
