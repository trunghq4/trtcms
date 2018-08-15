<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('position')->default('');
			$table->string('title')->default('');
			$table->text('url', 65535)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('link', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->integer('id_product')->unsigned()->default(0);
			$table->integer('id_news')->unsigned()->default(0);
			$table->integer('sort')->unsigned()->default(0);
			$table->text('time', 65535)->nullable();
			$table->integer('image_category')->unsigned()->default(0);
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
		Schema::drop('image');
	}

}
