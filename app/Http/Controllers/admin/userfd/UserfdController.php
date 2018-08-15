<?php namespace App\Http\Controllers\admin\userfd;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Request;

class UserfdController extends Controller {

	public function createTable($table_name){
		Schema::create($table_name, function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',255);
		});
	}

}
