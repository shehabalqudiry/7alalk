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
            $table->increments('id');
            $table->string('name');
            $table->string('short_desc');
            $table->text('long_desc');
            $table->text('services');
            $table->string('location');
            $table->string('map_address', 500);
            $table->integer('region_id');
            $table->integer('clinic_cat_id');
            $table->timestamps();

        });
        
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type');
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
        Schema::dropIfExists('clinics');
    }
}
