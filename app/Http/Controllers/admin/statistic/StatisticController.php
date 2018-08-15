<?php namespace App\Http\Controllers\admin\statistic;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session,Image,DB,Schema;
use App\model\AdminModel;
use Illuminate\Http\Request;

class StatisticController extends Controller {

	public function index(){
		if(!Session::has('user') || Session::get('user')->user == 0 || !Schema::hasTable('user')){
			return redirect(url('admin'));
		}else{
			$user = new AdminModel();
			$data['list_date'] = $user->getData('statistic_date',[],'id','desc',15);
			return view('admin.statistic.statistic_list',$data);
		}
	}
	public function date($id){
		if(!Session::has('user') || Session::get('user')->user == 0 || !Schema::hasTable('user')){
			return redirect(url('admin'));
		}else{
			$user = new AdminModel();
			$data['get_date'] = $user->getFirstRowWhere('statistic_date',['id' => $id]);
			$data['list_statistic'] = $user->getData('statistic',['date' => $data['get_date']->date],'id','desc',20);
			return view('admin.statistic.statistic_date',$data);
		}
	}

}
