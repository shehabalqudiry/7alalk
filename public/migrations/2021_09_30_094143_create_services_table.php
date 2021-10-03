<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	public function up()
	{
		Schema::create('services', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->unique();
			$table->text('desc');
			$table->string('image', 255);
			$table->bigInteger('section_id')->unsigned();
			$table->double('price', 8,2);
			$table->integer('status')->default('1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('services');
	}
}