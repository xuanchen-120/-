<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWechatMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wechat_menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id');
			$table->string('type', 32);
			$table->string('name', 32);
			$table->boolean('sort');
			$table->string('key', 32)->nullable();
			$table->string('url')->nullable();
			$table->string('media_id', 64)->nullable();
			$table->string('appid', 32)->nullable();
			$table->string('pagepath')->nullable();
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
		Schema::drop('wechat_menus');
	}

}
