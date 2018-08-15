<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB,Session,Cart,Whois,Mail,Socialite,Image,Schema,Request,Helper;
use App\model\FHomeModel;

abstract class Controller extends BaseController {
	public function __construct(){
		$user = new FHomeModel();
		if(Schema::hasTable('user')){
			if(!Session::has('lang')){
				Session::put('lang','vi');
			}
			$data['hot_product'] = $user->getData('product',['lang' => Session::get('lang'),'hot' => 1],'id','desc');
			view()->share('hot_product',$data['hot_product']);

			$module = $user->getData('module',[]);
			view()->share('module',$module);

			$site_option = $user->getFirstRowWhere('site_option',['lang' => Session::get('lang')]);
			view()->share('site_option',$site_option);

			$data['list_provider'] = $user->getData('product_provider',['lang' => Session::get('lang')]);
			view()->share('list_provider',$data['list_provider']);

			$data['list_cate'] = $user->getData('product_category',['lang' => Session::get('lang')]);
			view()->share('list_cate',$data['list_cate']);

			$list_country = $user->getData('product_country',['lang' => Session::get('lang')],'id','desc');
			view()->share('list_country',$list_country);

			$data['menu_top'] = $user->getMenuTop();
			view()->share('menu_top',$data['menu_top']);

			$data['menu_bot'] = $user->getMenuBottom();
			view()->share('menu_bot',$data['menu_bot']);

			$data['menu_left'] = $user->getMenuLeft();
			view()->share('menu_left',$data['menu_left']);

			$data['menu_child'] = $user->getMenuChild();
			view()->share('menu_child',$data['menu_child']);
			
			$count_order = $user->countData('order',['status' => 1]);
			view()->share('count_order',$count_order);
			if(Helper::site_option()->statistic == 1){
				$s_ip = $_SERVER['REMOTE_ADDR'];
				if(empty($_SERVER['HTTP_REFERER'])){
					$s_referer = "";
				}else{
					$s_referer = $_SERVER['HTTP_REFERER'];
				}
				$s_time = time();
				$s_day = date('d',time());
				$s_month = date('m',time());
				$s_year = date('Y',time());
				$s_date = [
					'day' => $s_day,
					'month' => $s_month,
					'year' => $s_year
				];
				$s_date = json_encode($s_date);
				$s_browser = $_SERVER['HTTP_USER_AGENT'];
				$s_url = $_SERVER['REQUEST_URI'];
				if(str_contains($s_url, 'admin') === false && str_contains($s_url, 'ajax')  === false){
					$count_date = $user->countData('statistic_date',['date' => $s_date]);
					if($count_date == 0){
						$user->insertData('statistic_date',['date' => $s_date]);
					}
					$user->insertData('statistic',[
						'ip' => $s_ip,
						'time' => $s_time,
						'date' => $s_date,
						'browser' => $s_browser,
						'referer' => $s_referer,
						'url' => $s_url,
						]);
				}
			}
			
		}
	}

}
