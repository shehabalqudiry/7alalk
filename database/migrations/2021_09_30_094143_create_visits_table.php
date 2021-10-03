<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration {

	public function up()
	{
		Schema::create('visits', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('name')->nullable();
			$table->string('phone', 50)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('visits');
	}
}