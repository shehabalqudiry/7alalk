<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('descibe')->nullable();
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            
            $table->date('date');
            
            $table->integer('number');
            $table->Integer('type');
            
            $table->integer('animal_id');
            $table->integer('address_id');
            $table->integer('user_id');
            $table->integer('case_id')->nullable();
            
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
        Schema::dropIfExists('clinic_orders');
    }
}
