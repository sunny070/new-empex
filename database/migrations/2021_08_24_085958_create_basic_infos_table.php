<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->cascade();
            $table->string('avatar')->nullable();
            $table->string('full_name');





            //added rj
            $table->string('notify_sms')->nullable();
            $table->string('new_id')->nullable();
            //added rj
            $table->date('dob');
            $table->string('email')->unique()->nullable();
            $table->enum('gender', ['Male', 'Female', 'Others']);
            $table->string('phone_no')->nullable();
            $table->string('parents_name');
            $table->foreignId('religion_id')->nullable()->cascade();
            $table->enum('caste', ['ST', 'SC', 'OBC', 'General'])->default('ST');
            $table->enum('marital_status', ['Single', 'Married'])->nullable();
            $table->string('aadhar_no')->nullable();
            $table->boolean('physically_challenge')->default(0);
            $table->enum('status', ['Pending', 'Verified', 'Approved', 'Rejected'])->default('Pending');
            $table->boolean('experienced')->default(0);
            $table->boolean('canEdit')->default(1);
            $table->date('card_valid_from')->nullable();
            $table->date('card_valid_till')->nullable();
            $table->enum('society', ['Mizo', 'Non-Mizo'])->default('Mizo');
            $table->string('percent_complete')->default('0');
            $table->longText('qr')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('ex_servicemen')->default(0);
            $table->text('notes')->nullable();
            $table->string('employment_no')->nullable();
            $table->integer('step')->default(1);
            $table->bigInteger('sponsorship_count')->default(0);
            $table->boolean('is_placed')->default(0);
            $table->boolean('is_archive')->default(0);
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
        Schema::dropIfExists('basic_infos');
    }
}
