<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id')->unsigned();
			$table->string('title', 64);
			$table->string('icon', 20)->nullable();
			$table->integer('sort')->unsigned();
			$table->string('uri')->nullable();
			$table->integer('status')->unsigned()->default(1);
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
		Schema::drop('admin_menus');
	}

}
