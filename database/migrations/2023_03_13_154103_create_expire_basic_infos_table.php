<?php

use App\Models\BasicInfo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpireBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expire_basic_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BasicInfo::class,'basic_info_id');
            $table->boolean('is_notified')->default(true);
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
        Schema::dropIfExists('expire_basic_infos');
    }
}
