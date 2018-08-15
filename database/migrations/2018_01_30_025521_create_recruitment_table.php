<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecruitmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recruitment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('position')->default('');
			$table->string('alias')->default('');
			$table->text('quantity', 65535)->nullable();
			$table->string('type')->default('');
			$table->text('experience', 65535)->nullable();
			$table->integer('category_id')->unsigned()->default(0);
			$table->text('salary', 65535)->nullable();
			$table->text('diploma', 65535)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('benefit', 65535)->nullable();
			$table->text('requirement', 65535)->nullable();
			$table->text('profile', 65535)->nullable();
			$table->text('image', 65535)->nullable();
			$table->text('thumb', 65535)->nullable();
			$table->text('time_out', 65535)->nullable();
			$table->text('time', 65535)->nullable();
			$table->integer('hot')->unsigned()->default(0);
			$table->integer('home')->unsigned()->default(0);
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
		Schema::drop('recruitment');
	}

}
