<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique('permissions_name_unique');
			$table->string('display_name')->nullable();
			$table->string('description')->nullable();
			$table->smallInteger('level')->unsigned()->nullable()->default(0);
			$table->string('icon', 20)->nullable();
			$table->integer('parent_id')->unsigned()->nullable()->default(0);
			$table->boolean('is_show')->nullable()->default(1);
			$table->smallInteger('order_num')->nullable()->default(0);
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
		Schema::drop('admin_permissions');
	}

}
