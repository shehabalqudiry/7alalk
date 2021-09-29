<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{

    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->bigInteger('clinic_id')->unsigned();
            $table->timestamps();

            $table->foreign('clinic_id')->references('id')->on('clinics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
