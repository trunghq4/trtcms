<?php namespace App\Http\Controllers\admin\download;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DownloadImageController extends Controller {

	public function index(){
		return view('admin.download.download');
	}

}
