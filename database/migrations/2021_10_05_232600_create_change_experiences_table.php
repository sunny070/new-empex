<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('designation')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('company')->nullable();
            $table->string('total_emoluments')->nullable();
            $table->string('leave_reason')->nullable();
            $table->boolean('is_working')->default(0);
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
        Schema::dropIfExists('change_experiences');
    }
}
