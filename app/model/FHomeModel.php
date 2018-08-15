<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB,Session,Cart,Whois,Mail,Socialite,Image;

class FHomeModel extends BaseModel {

	public function getMenuTop(){
		$data = $this->getData('menu',[
			'position' => 'top',
			'lang' => Session::get('lang'),
			'parent_id' => 0,
		],'sort','asc');
		return $data;
	}
	public function getMenuLeft(){
		$data = $this->getData('menu',[
			'position' => 'left',
			'lang' => Session::get('lang'),
			'parent_id' => 0,
		],'sort','asc');
		return $data;
	}
	public function getMenuRight(){
		$data = $this->getData('menu',[
			'position' => 'right',
			'lang' => Session::get('lang'),
			'parent_id' => 0,
		],'sort','asc');
		return $data;
	}
	public function getMenuBottom(){
		$data = $this->getData('menu',[
			'position' => 'bottom',
			'lang' => Session::get('lang'),
			'parent_id' => 0,
		],'sort','asc');
		return $data;
	}
	public function getMenuChild(){
		$data = DB::table('menu')
		->where('lang',Session::get('lang'))
		->where('parent_id','!=',0)
		->orderby('sort','asc')
		->get();
		return $data;
	}
	public function getProductFocus(){
		$data = DB::table('product')
		->join('product_category','product.category_id','=','product_category.id')
		->select('product.*','product_category.name as cate_name')
		->where('product.lang',Session::get('lang'))
		->where('product.focus',1)
		->first();
		return $data;
	}
	public function getProductHome(){
		$data = DB::table('product')
		->join('product_category','product.category_id','=','product_category.id')
		->select('product.*','product_category.name as cate_name')
		->where('product.lang',Session::get('lang'))
		->where('product.home',1)
		->get();
		return $data;
	}
	public function getProductHot(){
		$data = DB::table('product')
		->join('product_category','product.category_id','=','product_category.id')
		->select('product.*','product_category.name as cate_name')
		->where('product.lang',Session::get('lang'))
		->where('product.hot',1)
		->first();
		return $data;
	}
	public function getImageProduct(){
		$data = DB::table('image')
		->join('product','image.id_product','=','product.id')
		->where('image.id_product','>',0)
		->get();
		return $data;
	}
	public function getAllProduct($paginate=0){
		if ($paginate == 0) {
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->select('product.*','product_category.parent_id')
			->where(['product.lang' => Session::get('lang')])
			->orderby('product.id','desc')
			->get();
		}else{
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->select('product.*','product_category.parent_id')
			->where(['product.lang' => Session::get('lang')])
			->orderby('product.id','desc')
			->paginate($paginate);
		}
		return $data;
	}

}
