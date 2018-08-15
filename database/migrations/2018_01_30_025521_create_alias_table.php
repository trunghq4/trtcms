<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAliasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('alias')->default('');
			$table->string('type')->default('');
			$table->integer('product')->unsigned()->default(0);
			$table->integer('product_cate')->unsigned()->default(0);
			$table->integer('provider')->unsigned()->default(0);
			$table->integer('product_country')->unsigned()->default(0);
			$table->integer('news')->unsigned()->default(0);
			$table->integer('news_cate')->unsigned()->default(0);
			$table->integer('page')->unsigned()->default(0);
			$table->integer('user')->unsigned()->default(0);
			$table->integer('recruitment')->unsigned()->default(0);
			$table->integer('recruitment_cate')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alias');
	}

}
