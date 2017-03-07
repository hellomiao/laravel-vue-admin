<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminLoggerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_logger', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->default(0)->comment('用户id');
			$table->string('catalog', 10)->default('')->comment('类型');
			$table->string('url')->default('')->comment('url');
			$table->text('intro', 65535)->nullable()->comment('操作');
			$table->char('ip', 15)->default('127.0.0.1')->comment('操作ip');
			$table->integer('created_at')->unsigned()->default(0)->comment('操作时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_logger');
	}

}
