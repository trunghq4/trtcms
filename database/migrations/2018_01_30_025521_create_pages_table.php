<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->default('');
			$table->string('alias')->default('');
			$table->string('description')->default('');
			$table->text('content', 65535)->nullable();
			$table->integer('user_id')->unsigned()->default(0);
			$table->string('title_seo')->default('');
			$table->string('description_seo')->default('');
			$table->string('keyword_seo')->default('');
			$table->text('image', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->integer('home')->unsigned()->default(0);
			$table->integer('hot')->unsigned()->default(0);
			$table->integer('focus')->unsigned()->default(0);
			$table->text('time', 65535)->nullable();
			$table->integer('sort')->unsigned()->default(0);
			$table->bigInteger('view_count')->unsigned()->default(0);
			$table->string('lang', 2)->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}
