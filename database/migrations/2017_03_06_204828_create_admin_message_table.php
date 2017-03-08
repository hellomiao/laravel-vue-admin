<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_message', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 200)->nullable()->comment('标题');
			$table->integer('from_uid')->unsigned()->nullable()->default(0)->comment('发自');
			$table->integer('to_uid')->unsigned()->nullable()->default(0)->comment('发送至');
			$table->string('content', 500)->nullable()->comment('内容');
			$table->boolean('is_read')->nullable()->default(0)->comment('0未读 1已读');
			$table->integer('send_at')->unsigned()->nullable()->default(0)->comment('发送时间');
			$table->integer('created_at')->unsigned()->nullable()->default(0)->comment('创建时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_message');
	}

}
