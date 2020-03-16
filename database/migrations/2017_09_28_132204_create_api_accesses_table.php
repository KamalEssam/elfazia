<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateapiAccessesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('api_key');
            $table->string('device_id');
            $table->string('expire_key');
            $table->text("token")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('api_accesses');
    }
}
