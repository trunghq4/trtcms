<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('account')->default('');
			$table->string('name')->default('');
			$table->string('password')->default('');
			$table->integer('level')->unsigned()->default(0);
			$table->text('image', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->string('phone', 12)->default('');
			$table->string('address')->default('');
			$table->text('alias', 65535)->nullable();
			$table->string('company')->default('');
			$table->string('email')->default('');
			$table->integer('sort')->unsigned()->default(0);
			$table->integer('user')->unsigned()->default(0);
			$table->integer('news')->unsigned()->default(0);
			$table->integer('news_cate')->unsigned()->default(0);
			$table->integer('add_news')->unsigned()->default(0);
			$table->integer('add_news_cate')->unsigned()->default(0);
			$table->integer('edit_news')->unsigned()->default(0);
			$table->integer('edit_news_cate')->unsigned()->default(0);
			$table->integer('product')->unsigned()->default(0);
			$table->integer('product_cate')->unsigned()->default(0);
			$table->integer('add_product')->unsigned()->default(0);
			$table->integer('add_product_cate')->unsigned()->default(0);
			$table->integer('edit_product')->unsigned()->default(0);
			$table->integer('edit_product_cate')->unsigned()->default(0);
			$table->integer('page')->unsigned()->default(0);
			$table->integer('order')->unsigned()->default(0);
			$table->integer('gallery')->unsigned()->default(0);
			$table->integer('menu')->unsigned()->default(0);
			$table->integer('site_option')->unsigned()->default(0);
			$table->integer('module')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
