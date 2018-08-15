<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatisticTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statistic', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('ip', 65535)->nullable();
			$table->text('time', 65535)->nullable();
			$table->text('date', 65535)->nullable();
			$table->string('referer')->default('');
			$table->string('browser')->default('');
			$table->string('url')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('statistic');
	}

}
