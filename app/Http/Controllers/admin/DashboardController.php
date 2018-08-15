<?php namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Schema;
use Illuminate\Http\Request;

class DashboardController extends Controller {

	public function index(){
		if (Session::has('user') && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['count_news'] = $user->countData('news',['lang' => Session::get('lang')]);
			$data['count_product'] = $user->countData('product',['lang' => Session::get('lang')]);
			$data['count_contact'] = $user->countData('contact',[]);
			return view('admin.dashboard.dashboard',$data);
		}else{
			return redirect('admin');
		}
	}

}
