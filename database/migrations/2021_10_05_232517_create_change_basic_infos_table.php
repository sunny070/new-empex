<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeBasicInfosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('change_basic_infos', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->cascade();
			$table->string('avatar')->nullable(); // if null copy path from basic info
			$table->string('full_name');
			$table->string('email')->nullable();
			$table->date('dob');
			$table->enum('gender', ['Male', 'Female', 'Others']);
			$table->string('phone_no');
			$table->string('parents_name');
			$table->foreignId('religion_id')->cascade();
			$table->enum('caste', ['ST', 'SC', 'OBC', 'General'])->default('ST');
			$table->enum('marital_status', ['Single', 'Married'])->nullable();
			$table->string('aadhar_no')->nullable();
			$table->boolean('physically_challenge')->default(0);
			$table->enum('society', ['Mizo', 'Non-Mizo'])->default('Mizo');
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
		Schema::dropIfExists('change_basic_infos');
	}
}
