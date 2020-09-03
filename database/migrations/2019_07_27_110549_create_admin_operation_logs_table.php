<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminOperationLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_operation_logs', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('admin_id')->unsigned()->index();
			$table->string('path');
			$table->string('method', 10);
			$table->string('ip', 15);
			$table->text('input')->nullable();
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_operation_logs');
	}

}
