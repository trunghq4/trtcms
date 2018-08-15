<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_config', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->text('image', 65535)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('content', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_config');
	}

}
