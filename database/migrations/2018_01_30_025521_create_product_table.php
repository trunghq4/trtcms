<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->string('type')->default('');
			$table->string('style')->default('');
			$table->text('code', 65535)->nullable();
			$table->string('alias')->default('');
			$table->text('size', 65535)->nullable();
			$table->text('image', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->bigInteger('price')->unsigned()->default(0);
			$table->bigInteger('price_sale')->unsigned()->default(0);
			$table->text('description', 65535)->nullable();
			$table->string('title_seo')->default('');
			$table->string('description_seo')->default('');
			$table->string('keyword_seo')->default('');
			$table->integer('active')->unsigned()->default(0);
			$table->text('time', 65535)->nullable();
			$table->integer('new')->unsigned()->default(0);
			$table->integer('hot')->unsigned()->default(0);
			$table->integer('home')->unsigned()->default(0);
			$table->integer('focus')->unsigned()->default(0);
			$table->integer('status')->unsigned()->default(0);
			$table->integer('sort')->unsigned()->default(0);
			$table->text('content', 65535)->nullable();
			$table->text('info', 65535)->nullable();
			$table->text('guarantee', 65535)->nullable();
			$table->integer('category_id')->unsigned()->default(0);
			$table->integer('provider_id')->unsigned()->default(0);
			$table->integer('country_id')->unsigned()->default(0);
			$table->integer('user_id')->unsigned()->default(0);
			$table->text('tags', 65535)->nullable();
			$table->text('view_count', 65535)->nullable();
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
		Schema::drop('product');
	}

}
