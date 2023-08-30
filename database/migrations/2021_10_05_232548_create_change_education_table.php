<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeEducationTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('change_education', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id');
			$table->foreignId('qualification_id')->cascade();
			$table->string('school');
			$table->foreignId('subject_id')->cascade()->nullable();
			$table->foreignId('major_core_id')->cascade()->nullable();
			$table->string('year_of_passing');
			$table->string('certificate')->nullable();
			$table->enum('division', ['Distinction', 'First', 'Second', 'Third'])->nullable();
			$table->string('course_duration')->nullable();
			$table->string('custom_subject')->nullable();
			$table->string('custom_major_core')->nullable();
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
		Schema::dropIfExists('change_education');
	}
}
