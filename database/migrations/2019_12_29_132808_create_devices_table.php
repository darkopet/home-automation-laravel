<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->integer('pin');
            $table->boolean('status')->default(0)->nullable();
            $table->unsignedInteger('device_type_id');
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('device_type_id')
                ->references('id')
                ->on('device_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
