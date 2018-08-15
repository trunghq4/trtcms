<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Session,DB;

class FProductModel extends BaseModel {

	public function getProductByAlias($alias){
		$data = DB::table('product')
		->join('product_category','product.category_id','=','product_category.id')
		->join('product_provider','product.provider_id','=','product_provider.id')
		->join('product_country','product.country_id','=','product_country.id')
		->select(
			'product.*',
			'product_category.name as cate_name',
			'product_category.alias as cate_alias',
			'product_category.parent_id',
			'product_provider.name as provider_name',
			'product_provider.alias as provider_alias',
			'product_country.name as country_name',
			'product_country.alias as country_alias')
		->where([
			'product.alias' => $alias,
			'product.lang' => Session::get('lang')])
		->first();
		return $data;
	}
	public function getProductByCate($category_id,$paginate=0){
		if($paginate == 0){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('product_to_category','product.id','=','product_to_category.id_product')
			->join('product_provider','product.provider_id','=','product_provider.id')
			->join('product_country','product.country_id','=','product_country.id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product_category.alias as cate_alias',
				'product_category.parent_id',
				'product_provider.name as provider_name',
				'product_provider.alias as provider_alias',
				'product_country.name as country_name',
				'product_country.alias as country_alias')
			->where([
				'product_to_category.id_category' => $category_id,
				'product.lang' => Session::get('lang')])
			->get();
			return $data;
		}else{
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('product_to_category','product.id','=','product_to_category.id_product')
			->join('product_provider','product.provider_id','=','product_provider.id')
			->join('product_country','product.country_id','=','product_country.id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product_category.alias as cate_alias',
				'product_category.parent_id',
				'product_provider.name as provider_name',
				'product_provider.alias as provider_alias',
				'product_country.name as country_name',
				'product_country.alias as country_alias')
			->where([
				'product_to_category.id_category' => $category_id,
				'product.lang' => Session::get('lang')])
			->paginate($paginate);
			return $data;
		}
	}
	public function getProductByProvider($provider_id,$paginate=0){
		if($paginate == 0){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('product_provider','product.provider_id','=','product_provider.id')
			->join('product_country','product.country_id','=','product_country.id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product_category.alias as cate_alias',
				'product_category.parent_id',
				'product_provider.name as provider_name',
				'product_provider.alias as provider_alias',
				'product_country.name as country_name',
				'product_country.alias as country_alias')
			->where([
				'product.provider_id' => $provider_id,
				'product.lang' => Session::get('lang')])
			->get();
			return $data;
		}else{
			$data = DB::table('product')
			->join('product_category','product.provider_id','=','product_category.id')
			->join('product_provider','product.provider_id','=','product_provider.id')
			->join('product_country','product.country_id','=','product_country.id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product_category.alias as cate_alias',
				'product_category.parent_id',
				'product_provider.name as provider_name',
				'product_provider.alias as provider_alias',
				'product_country.name as country_name',
				'product_country.alias as country_alias')
			->where([
				'product.provider_id' => $provider_id,
				'product.lang' => Session::get('lang')])
			->paginate($paginate);
			return $data;
		}
	}
	public function getProductByCountry($country_id,$paginate=0){
		if($paginate == 0){
			$data = DB::table('product')
			->join('product_category','product.category_id','=','product_category.id')
			->join('product_provider','product.provider_id','=','product_provider.id')
			->join('product_country','product.country_id','=','product_country.id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product_category.alias as cate_alias',
				'product_category.parent_id',
				'product_provider.name as provider_name',
				'product_provider.alias as provider_alias',
				'product_country.name as country_name',
				'product_country.alias as country_alias')
			->where([
				'product.country_id' => $country_id,
				'product.lang' => Session::get('lang')])
			->get();
			return $data;
		}else{
			$data = DB::table('product')
			->join('product_category','product.provider_id','=','product_category.id')
			->join('product_provider','product.provider_id','=','product_provider.id')
			->join('product_country','product.country_id','=','product_country.id')
			->select(
				'product.*',
				'product_category.name as cate_name',
				'product_category.alias as cate_alias',
				'product_category.parent_id',
				'product_provider.name as provider_name',
				'product_provider.alias as provider_alias',
				'product_country.name as country_name',
				'product_country.alias as country_alias')
			->where([
				'product.country_id' => $country_id,
				'product.lang' => Session::get('lang')])
			->paginate($paginate);
			return $data;
		}
	}
	public function getProductSimilar($id,$paginate){
		$product = $this->getFirstRowWhere('product',['id' => $id]);
		$product_sim = DB::table('product')
		->where('category_id',$product->category_id)
		->where('id','!=',$id)->orderby('id','desc')
		->paginate($paginate);
		return $product_sim;
	}

}
