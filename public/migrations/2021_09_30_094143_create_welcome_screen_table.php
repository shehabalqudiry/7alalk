<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWelcomeScreenTable extends Migration {

	public function up()
	{
		Schema::create('welcome_screen', function(Blueprint $table) {
			$table->increments('id');
			$table->string('image', 255);
			$table->text('text');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('welcome_screen');
	}
}