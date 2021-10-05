<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration {

	public function up()
	{
		Schema::create('packages', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('desc');
			$table->double('price', 8,2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('packages');
	}
}