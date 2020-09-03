<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('sn')->unsigned();
			$table->integer('psn')->unsigned()->index('psn');
			$table->string('province', 200);
			$table->string('city', 200);
			$table->string('area', 200);
			$table->string('name', 200);
			$table->string('shortname', 200);
			$table->string('type', 50);
			$table->string('cnname');
			$table->string('enname');
			$table->string('info');
			$table->string('shortinfo');
			$table->integer('zone')->unsigned();
			$table->integer('zip')->unsigned();
			$table->decimal('lng', 10, 7);
			$table->decimal('lat', 10, 7);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('areas');
	}

}
