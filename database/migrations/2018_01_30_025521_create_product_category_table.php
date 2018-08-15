<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_category', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->string('title_seo')->default('');
			$table->string('description_seo')->default('');
			$table->string('keyword_seo')->default('');
			$table->text('image', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->text('time', 65535)->nullable();
			$table->string('alias')->default('');
			$table->integer('parent_id')->unsigned()->default(0);
			$table->text('description', 65535)->nullable();
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
		Schema::drop('product_category');
	}

}
