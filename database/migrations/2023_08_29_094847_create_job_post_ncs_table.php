<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostNcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_post_ncs', function (Blueprint $table) {
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
            $table->string('created_by'); // ref: admin_id (creator)
            $table->boolean('published')->default(0); // Add a unique slug column
            $table->string('url')->nullable();
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
        Schema::dropIfExists('job_post_ncs');
    }
}
