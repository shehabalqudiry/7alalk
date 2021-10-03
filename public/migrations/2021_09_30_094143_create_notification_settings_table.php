<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationSettingsTable extends Migration {

	public function up()
	{
		Schema::create('notification_settings', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('push_all_sections')->default('1');
			$table->boolean('push_account_and_orders');
			$table->boolean('push_special_orders');
			$table->boolean('push_rewards');
			$table->string('push_ratings');
			$table->boolean('email_offers_products');
			$table->boolean('email_all_sections');
			$table->boolean('email_rating_product');
			$table->boolean('email_q_answers');
			$table->string('mobile_account_and_orders');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notification_settings');
	}
}