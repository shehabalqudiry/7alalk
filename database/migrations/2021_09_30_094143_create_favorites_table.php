<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration {

	public function up()
	{
		Schema::create('favorites', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->timestamps();
		});

	}

	public function down()
	{
		Schema::drop('favorites');
	}
}
