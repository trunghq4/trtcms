<?php namespace App\Http\Controllers\admin\sitemap;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Helper;
use Illuminate\Http\Request;

class SitemapController extends Controller {

	public function regenate(){
		Helper::updateSitemap();
	}

}
