<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteOptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_option', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('url')->default('');
			$table->string('name')->default('');
			$table->string('slogan')->default('');
			$table->text('logo', 65535)->nullable();
			$table->text('favicon', 65535)->nullable();
			$table->text('watermark', 65535)->nullable();
			$table->string('description_seo')->default('');
			$table->string('keyword_seo')->default('');
			$table->string('email')->default('');
			$table->string('facebook')->default('');
			$table->string('google')->default('');
			$table->string('skype')->default('');
			$table->text('address', 65535)->nullable();
			$table->string('hotline1')->default('');
			$table->string('hotline2')->default('');
			$table->string('hotline3')->default('');
			$table->string('fax')->default('');
			$table->integer('statistic')->unsigned()->default(0);
			$table->integer('maintenance')->unsigned()->default(0);
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
		Schema::drop('site_option');
	}

}
