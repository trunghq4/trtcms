<?php namespace App\Http\Controllers\frontend\search;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB,Session,Cart,Whois,Mail,Socialite,Image;
use App\model\FHomeModel;
use App\model\FProductModel;
use App\model\FNewsModel;
use Illuminate\Http\Request;

class SearchController extends Controller {

	public function searchNews(){
		$str = $_GET['search_news'];
		$user = new FNewsModel();
		if($str != ""){
			$data['list_news'] = $user->search($str,12);
			return view('frontend.search.search_news',$data);
		}
	}
	public function searchProduct(){
		$user = new FProductModel();
		$name = $_GET['search_product'];
		$category_id = $_GET['category_id'];
		if($_GET['price'] == 0){
			$price = 0;
		}else{
			$price = explode(' ',$_GET['price']);
		}
		if($name != ""){
			$data['product'] = DB::table('product')->where('name','like','%'.$name.'%')->orwhere('code','=',$name)->get();
		}else{
			if($category_id == 1){
				if($price == 0){
					return redirect()->back();
				}else{
					if($price[0] == 1){
						$data['product'] = DB::table('product')->where('price_sale','<',1000000)->get();
					}elseif($price[1] == 1){
						$data['product'] = DB::table('product')->where('price_sale','>',5000000)->get();
					}else{
						$data['product'] = DB::table('product')->where('price_sale','<',$price[1])->get();
					}
				}
			}else{
				if($price == 0){
					$data['product'] = DB::table('product')->where('category_id',$category_id)->get();
				}else{
					if($price[0] == 1){
						$data['product'] = DB::table('product')->where('category_id',$category_id)->where('price_sale','<',1000000)->get();
					}elseif($price[1] == 1){
						$data['product'] = DB::table('product')->where('category_id',$category_id)->where('price_sale','>',5000000)->get();
					}else{
						$data['product'] = DB::table('product')->where('category_id',$category_id)->where('price_sale','<',$price[1])->get();
					}
				}
			}
		}
		return view('frontend.search.search_product',$data);
	}

}
