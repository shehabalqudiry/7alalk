<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration {

	public function up()
	{
		Schema::create('address', function(Blueprint $table) {
			$table->increments('id');
			$table->string('address1', 255);
			$table->string('address2', 255);
			$table->integer('country_id');
			$table->integer('region_id');
			$table->integer('user_id');
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('address');
	}
}