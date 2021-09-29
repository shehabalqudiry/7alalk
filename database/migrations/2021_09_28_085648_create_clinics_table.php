<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_desc');
            $table->text('long_desc');
            $table->text('services');
            $table->string('location');
            $table->string('map_address', 500);
            $table->bigInteger('region_id')->unsigned();
            $table->bigInteger('clinic_cat_id')->unsigned();
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('clinic_cat_id')->references('id')->on('clinic_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
