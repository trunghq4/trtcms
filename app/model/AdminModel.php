<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB,Session;

class AdminModel extends BaseModel {

	public function getAllNews($paginate=""){
		if($paginate != ""){
			$data = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->join('user','news.user_id','=','user.id')
			->select('category.title as cate_title','news.*')
			->orderby('news.id','desc')
			->where('news.lang',Session::get('lang'))
			->paginate($paginate);
			return $data;
		}else{
			$data = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->join('user','news.user_id','=','user.id')
			->select('category.title as cate_title','news.*')
			->orderby('news.id','desc')
			->where('news.lang',Session::get('lang'))
			->get();
			return $data;
		}
	}
	public function getAllRecruitment(){
		$data = DB::table('recruitment')
		->join('recruitment_category','recruitment.category_id','=','recruitment_category.id')
		->select('recruitment.*','recruitment_category.position as cate_position')
		->get();
		return $data;
	}
	public function getAllProduct($paginate = 0){
		if($paginate == 0){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where('product.lang',Session::get('lang'))
			->orderby('product.id','desc')
			->get();
		}else{
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where('product.lang',Session::get('lang'))
			->orderby('product.id','desc')
			->paginate($paginate);
		}
		return $data;
	}
	public function getProductSearch($where){
		$data = DB::table('product')
		->join('product_category','product.category_id','=','product_category.id')
		->join('user','product.user_id','=','user.id')
		->join('product_provider','product_provider.id','=','product.provider_id')
		->select('product.id','product.name','product.content','product.time','product.sort','product.thumb','product.category_id','product_category.name as cate_name','product.home','product.hot','product.focus','product.provider_id','product_provider.name as provider_name')
		->where('product.lang',Session::get('lang'))
		->where($where)->orderby('product.id','desc')
		->paginate(20);
		return $data;
	}
	public function getListProductImage(){
		$data = DB::table('image')
		->join('product','image.id_product','=','product.id')
		->select('image.id','image.sort','image.id_product','image.title','image.thumb','image.position','product.name as pro_name')
		->orderby('id_product','desc')
		->where('image.lang',Session::get('lang'))
		->get();
		return $data;
	}
	public function getProductLike($like,$paginate=""){
		if($paginate == ""){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product.home','product.hot',
				'product.focus',
				'product.provider_id',
				'product_provider.name as provider_name'
			)
			->where('product.lang',Session::get('lang'))
			->where('product.name','like','%'.str_replace(' ', '%', $like).'%')
			->orderby('product.id','desc')
			->get();
		}else{
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product.home','product.hot',
				'product.focus',
				'product.provider_id',
				'product_provider.name as provider_name'
			)
			->where('product.lang',Session::get('lang'))
			->where('product.name','like','%'.str_replace(' ', '%', $like).'%')
			->orderby('product.id','desc')
			->paginate($paginate);
		}
		return $data;
	}
	public function getSearchProductByCate($id,$paginate=""){
		if($paginate == ""){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('product_to_category','product.id','=','product_to_category.id_product')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where(['product.lang'=>Session::get('lang'),'product_to_category.id_category' => $id])
			->orderby('product.id','desc')
			->get();
		}else{
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('product_to_category','product.id','=','product_to_category.id_product')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where(['product.lang'=>Session::get('lang'),'product_to_category.id_category' => $id])
			->orderby('product.id','desc')
			->paginate($paginate);
		}
		return $data;
	}
	public function getSearchProductByProvider($id,$paginate=""){
		if($paginate == ""){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where(['product.lang'=>Session::get('lang'),'product.provider_id' => $id])
			->orderby('product.id','desc')
			->get();
		}else{
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where(['product.lang'=>Session::get('lang'),'product.provider_id' => $id])
			->orderby('product.id','desc')
			->paginate($paginate);
		}
		return $data;
	}
	public function getSearchProductByCountry($id,$paginate=""){
		if($paginate == ""){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where(['product.lang'=>Session::get('lang'),'product.country_id' => $id])
			->orderby('product.id','desc')
			->get();
		}else{
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('user','product.user_id','=','user.id')
			->join('product_provider','product_provider.id','=','product.provider_id')
			->select('product.*','product_category.name as cate_name','product.provider_id','product_provider.name as provider_name')
			->where(['product.lang'=>Session::get('lang'),'product.country_id' => $id])
			->orderby('product.id','desc')
			->paginate($paginate);
		}
		return $data;
	}
}
