<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentReplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_reply', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('comment_id')->unsigned()->default(0);
			$table->string('customer')->default('');
			$table->text('customer_option', 65535)->nullable();
			$table->integer('admin_id')->unsigned()->default(0);
			$table->text('content', 65535)->nullable();
			$table->integer('publish')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comment_reply');
	}

}
