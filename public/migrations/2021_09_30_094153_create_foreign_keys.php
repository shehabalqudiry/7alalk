<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('currency', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('package_id')->references('id')->on('packages')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('clinics', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('currency', function(Blueprint $table) {
			$table->dropForeign('currency_country_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_package_id_foreign');
		});
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_country_id_foreign');
		});
		Schema::table('clinics', function(Blueprint $table) {
			$table->dropForeign('clinics_city_id_foreign');
		});
	}
}