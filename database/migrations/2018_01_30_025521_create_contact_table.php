<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->string('email')->default('');
			$table->string('phone')->default('');
			$table->string('address')->default('');
			$table->text('note', 65535)->nullable();
			$table->text('comment', 65535)->nullable();
			$table->text('time', 65535)->nullable();
			$table->integer('display')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contact');
	}

}
