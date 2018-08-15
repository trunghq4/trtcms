<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->default('');
			$table->text('description', 65535)->nullable();
			$table->text('image', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->text('content', 65535)->nullable();
			$table->string('alias')->default('');
			$table->integer('category_id')->unsigned()->default(0);
			$table->integer('user_id')->unsigned()->default(0);
			$table->text('tags', 65535)->nullable();
			$table->text('time', 65535)->nullable();
			$table->string('title_seo')->default('');
			$table->string('description_seo')->default('');
			$table->string('keyword_seo')->default('');
			$table->integer('publish')->unsigned()->default(0);
			$table->integer('hot')->unsigned()->default(0);
			$table->integer('home')->unsigned()->default(0);
			$table->integer('focus')->unsigned()->default(0);
			$table->integer('sort')->unsigned()->default(0);
			$table->text('view_count', 65535)->nullable();
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
		Schema::drop('news');
	}

}
