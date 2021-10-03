<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('offer');
            $table->text('desc');
            $table->date('start');
            $table->date('end');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('offer_user', function (Blueprint $table) {
            $table->integer('offer_id');
            $table->integer('user_id');     
        });
        
        Schema::create('offer_product', function (Blueprint $table) {
            $table->integer('offer_id');
            $table->integer('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
