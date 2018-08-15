<?php namespace App\Http\Controllers\admin\lang;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session,DB;
use Illuminate\Http\Request;

class LanguageController extends Controller {

	public function change($lang){
		Session::put('lang',$lang);
		return redirect()->back();
	}

}
