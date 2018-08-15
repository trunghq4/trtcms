<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->string('address')->default('');
			$table->text('phone', 65535)->nullable();
			$table->string('email')->default('');
			$table->text('note', 65535)->nullable();
			$table->text('content', 65535)->nullable();
			$table->integer('id_product')->unsigned()->default(0);
			$table->text('time', 65535)->nullable();
			$table->text('code', 65535)->nullable();
			$table->text('price_sale', 65535)->nullable();
			$table->text('total_price', 65535)->nullable();
			$table->integer('status')->unsigned()->default(0);
			$table->string('admin')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order');
	}

}
