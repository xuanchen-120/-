<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_infos', function(Blueprint $table)
		{
			$table->increments('user_id');
			$table->string('nickname', 32);
			$table->boolean('sex')->default(0);
			$table->string('storage')->nullable();
			$table->string('idcard', 50)->nullable();
			$table->integer('desires')->unsigned()->default(0)->comment('发愿总数');
			$table->boolean('subscribe')->nullable();
			$table->dateTime('subscribed_at')->nullable();
			$table->string('subscribe_scene', 32)->nullable();
			$table->integer('qr_scene')->nullable();
			$table->string('qr_scene_str', 32)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_infos');
	}

}
