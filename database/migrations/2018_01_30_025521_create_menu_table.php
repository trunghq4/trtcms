<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->string('url')->default('');
			$table->string('position')->default('');
			$table->text('icon', 65535)->nullable();
			$table->integer('parent_id')->unsigned()->default(0);
			$table->text('description', 65535)->nullable();
			$table->string('module')->default('');
			$table->integer('product_cate')->unsigned()->default(0);
			$table->integer('news_cate')->unsigned()->default(0);
			$table->integer('page')->unsigned()->default(0);
			$table->integer('sort')->unsigned()->default(0);
			$table->integer('home')->unsigned()->default(0);
			$table->string('lang', 3)->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu');
	}

}
