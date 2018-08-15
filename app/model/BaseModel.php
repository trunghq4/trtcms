<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;
use DB,Session;

class BaseModel extends Model {

	public function site_option(){
		$data = $this->getFirstRowWhere('site_option',['lang' => Session::get('lang')]);
		return $data;
	}
	public function getAll($table){
		$data = DB::table($table)
		->get();
		return $data;
	}
	public function getFirstRow($table){
		$data = DB::table($table)
		->first();
		return $data;
	}
	public function getFirstRowWhere($table,$arr){
		$data = DB::table($table)
		->where($arr)
		->first();
		return $data;
	}
	public function getData($table,$arr,$order='id',$by='asc',$paginate=0){
		if($paginate == 0){
			$data = DB::table($table)
			->where($arr)
			->orderby($order,$by)
			->get();
			return $data;
		}else{
			$data = DB::table($table)
			->where($arr)
			->orderby($order,$by)
			->paginate($paginate);
			return $data;
		}
	}
	public function countData($table,$arr){
		$data = DB::table($table)
		->where($arr)
		->count();
		return $data;
	}
	public function insertData($table,$arr){
		DB::table($table)
		->insert($arr);
	}
	public function updateData($table,$where,$arr){
		DB::table($table)
		->where($where)
		->update($arr);
	}
	public function deleteData($table,$arr){
		DB::table($table)
		->where($arr)
		->delete();
	}

}
