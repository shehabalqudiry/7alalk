<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('desc', 255);
			$table->string('logo', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}