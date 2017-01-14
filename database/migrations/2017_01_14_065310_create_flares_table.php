<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flares', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->timestamp('activated_on');
            $table->timestamp('cleared_on')->nullable();
            $table->string('type');
            $table->double('long', 15, 8);
            $table->double('lat', 15, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flares');
    }
}
