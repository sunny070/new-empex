<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file')->nullable();
            $table->string('employer_name')->nullable();
            $table->text('address')->nullable();
            $table->string('district')->nullable();
            $table->string('male_per_post')->nullable();
            $table->string('female_per_post')->nullable();
            $table->date('min_age')->nullable();
            $table->date('max_age')->nullable();
            $table->enum('category', ['ST', 'SC', 'OBC', 'General', 'ExServicemen'])->nullable();
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('sponsorships');
    }
}
