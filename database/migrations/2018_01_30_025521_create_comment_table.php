<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('customer_name')->default('');
			$table->text('customer_option', 65535)->nullable();
			$table->text('url', 65535)->nullable();
			$table->text('content', 65535)->nullable();
			$table->integer('admin_id')->unsigned()->default(0);
			$table->integer('publish')->unsigned()->default(0);
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
		Schema::drop('comment');
	}

}
