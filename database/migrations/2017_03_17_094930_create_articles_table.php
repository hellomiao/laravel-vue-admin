<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->smallInteger('type')->unsigned()->nullable()->default(0)->comment('类型');
			$table->integer('category_id')->unsigned()->nullable()->default(0)->comment('分类id');
			$table->string('picture', 100)->nullable()->default('')->comment('封面');
			$table->string('title', 50)->nullable();
			$table->string('tags', 200)->nullable();
			$table->string('info', 500)->default('')->comment('简介');
			$table->text('content', 65535)->nullable();
			$table->integer('view_num')->unsigned()->nullable()->default(0)->comment('浏览数量');
			$table->boolean('is_hot')->nullable()->default(0);
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
		Schema::drop('articles');
	}

}
