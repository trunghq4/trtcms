<?php namespace App\Http\Controllers\frontend\tag;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\FNewsModel;
use Illuminate\Http\Request;

class TagController extends Controller {

	public function index($alias){
		dd($alias);
		$user = new FNewsModel();
		$data['news'] = $user->getNewsByTags($alias);
		dd($data['news']);
	}

}
