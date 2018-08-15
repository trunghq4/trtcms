<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB,Session,Cart,Whois,Mail,Socialite,Image;

class FNewsModel extends BaseModel {

	public function getNewsByAlias($alias){
		$data = DB::table('news')
		->join('category','news.category_id','=','category.id')
		->select(
			'news.*',
			'category.title as cate_title',
			'category.alias as cate_alias',
			'category.parent_id'
		)
		->where([
			'news.alias' => $alias,
			'news.lang' => Session::get('lang')
		])
		->first();
		return $data;
	}
	public function getNewsByCategory($category_id,$paginate=0){
		if($paginate == 0){
			$data = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->join('news_to_category','news.id','=','news_to_category.id_news')
			->select(
				'news.*',
				'category.title as cate_title',
				'category.alias as cate_alias',
				'category.parent_id'
			)
			->where([
				'news_to_category.id_category' => $category_id,
				'news.publish' => 1,
				'news.lang' => Session::get('lang')
			])
			->orderby('id','desc')
			->get();
			return $data;
		}else{
			$data = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->join('news_to_category','news.id','=','news_to_category.id_news')
			->select(
				'news.*',
				'category.title as cate_title',
				'category.alias as cate_alias',
				'category.parent_id'
			)
			->where([
				'news_to_category.id_category' => $category_id,
				'news.publish' => 1,
				'news.lang' => Session::get('lang')
			])
			->orderby('id','desc')
			->paginate($paginate);
			return $data;
		}
	}
	public function search($str,$paginate=0){
		$str = str_replace(' ', '%', $str);
		if($paginate == 0){
			$data = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->select(
				'news.*',
				'category.title as cate_title',
				'category.alias as cate_alias',
				'category.parent_id'
			)
			->where('news.title','like','%'.$str.'%')
			->where('news.publish',1)
			->get();
			return $data;
		}else{
			$data = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->select(
				'news.*',
				'category.title as cate_title',
				'category.alias as cate_alias',
				'category.parent_id'
			)
			->where('news.title','like','%'.$str.'%')
			->where('news.publish',1)
			->paginate($paginate);
			return $data;
		}
	}
	public function getNewsByTags($alias){
		$get_tag = DB::table('tags')
		->where('alias',$alias)
		->get();
		$arr = [];
		foreach ($get_tag as $key => $value) {
			$arr[$key] = $value->id_news;
		}
		$data = DB::table('news')
		->join('category','news.category_id','=','category.id')
		->select(
			'news.*',
			'category.title as cate_title',
			'category.alias as cate_alias',
			'category.parent_id'
		)
		->whereIn('news.id',$arr)
		->get();
		return $data;
	}

}
