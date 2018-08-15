<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('description', 65535)->nullable();
			$table->text('image', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->integer('parent_id')->unsigned()->default(0);
			$table->string('alias')->default('');
			$table->text('time', 65535)->nullable();
			$table->string('title_seo')->default('');
			$table->string('description_seo')->default('');
			$table->string('keyword_seo')->default('');
			$table->integer('home')->unsigned()->default(0);
			$table->integer('hot')->unsigned()->default(0);
			$table->integer('focus')->unsigned()->default(0);
			$table->integer('sort')->unsigned()->default(0);
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
		Schema::drop('category');
	}

}
