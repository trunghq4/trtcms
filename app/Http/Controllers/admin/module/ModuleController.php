<?php namespace App\Http\Controllers\admin\module;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session,DB,Image,Helper,Schema;
use App\model\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModuleController extends Controller {

	public function index(){
		if(Session::has('user') && Session::get('user')->site_option == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$data['list_module'] = $user->getData('module',[]);
			return view('admin.module.list',$data);
		}else{
			return redirect('admin');
		}
	}
	public function getAdd(){
		if(Session::has('user') && Session::get('user')->site_option == 1 && Schema::hasTable('user')){
			return view('admin.module.add');
		}else{
			return redirect('admin');
		}
	}
	public function postAdd(){
		if (isset($_POST['submit'])) {
			$user = new AdminModel();
			$table_name = $_POST['table_name'];
			if(Schema::hasTable($table_name)){
				Session::flash('error','Tên bảng đã tồn tại');
				return redirect()->back();
			}else{
				Schema::create($table_name, function(Blueprint $table){
					$column = $_POST['column'];
					$table->increments('id');
					for($i=1;$i<=$column;$i++){
						$str_name = 'name'.$i;
						$name[$i] = $_POST[$str_name];
						$str_type = 'type'.$i;
						$type[$i] = $_POST[$str_type];
						$str_length = 'length'.$i;
						$length[$i] = $_POST[$str_length];
						if($name[$i] != ''){
							if($type[$i] == 0 || $type[$i] == 3){
								$table->text($name[$i]);
							}elseif($type[$i] == 1){
								$table->biginteger($name[$i])->length($length[$i])->unsigned();
							}elseif($type[$i] == 2){
								$table->string($name[$i],$length[$i]);
							}elseif($type[$i] == 4){
								$table->date($name[$i]);
							}
						}
					}

				});
				$module_name = $_POST['module_name'];
				$column = $_POST['column'];
				$fields = [];
				for($i =1;$i<=$column;$i++){
					$str_name = 'name'.$i;
					$name = $_POST[$str_name];
					$str_display_name = 'display_name'.$i;
					$display_name = $_POST[$str_display_name];
					$str_type = 'type'.$i;
					$type = $_POST[$str_type];
					if($type == 0): $type = 3; endif;
					$str_length = 'length'.$i;
					$length = $_POST[$str_length];
					$str_display_type = 'display_type'.$i;
					$display_type = $_POST[$str_display_type];
					$str_option = 'option'.$i;
					if(isset($_POST[$str_option])){
						$option = $_POST[$str_option];
					}else{
						$option = "";
					}
					if($name != "" && $display_name != ""){
						$fields[$i] = ['name' => $name,'display_name' => $display_name,'type' => $type,'display_type' => $display_type, 'option' => $option, 'length' => $length];
					}
				}

				$arr = [
					'name' => $module_name,
					'table_name' => $table_name,
					'column' => count($fields),
					'fields' => json_encode($fields),
				];
				$user->insertData('module',$arr);
				if(!is_dir('public/upload/'.$table_name)){
					mkdir('public/upload/'.$table_name);
				}
				Session::flash('success','Thêm thành công');
				return redirect('admin/list-module');
			}
			
		}
	}
	public function del($id){
		if(Session::has('user') && Session::get('user')->site_option == 1 && Schema::hasTable('user') && $id > 10){
			$user= new AdminModel();
			$module = $user->getFirstRowWhere('module',['id' => $id]);
			if(Schema::hasTable($module->table_name)){
				Schema::drop($module->table_name);
			}
			$user->deleteData('module',['id'=>$id]);
			if(is_dir('public/upload/'.$module->table_name)){
				Helper::remove_allfile('public/upload/'.$module->table_name);
				rmdir('public/upload/'.$module->table_name);
			}
			Session::flash('success','Xóa Module thành công');
			return redirect(url('admin/list-module'));
		}else{
			return redirect('admin');
		}

	}
	public function module_index($table){
		if(Session::has('user') && Session::get('user')->site_option == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$data['module_detail'] = $user->getFirstRowWhere('module',['table_name' => $table]);
			$data['data'] = $user->getData($table,[]);
			// dd($data['data']);
			return view('admin.module.detail.list',$data);
		}else{
			return redirect('admin');
		}
	}
	public function getModuleAdd($table){
		if(Session::has('user') && Session::get('user')->site_option == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$data['module_detail'] = $user->getFirstRowWhere('module',['table_name' => $table]);
			$data['data'] = $user->getData($table,[]);
			// dd(json_decode($data['module_detail']->fields));
			return view('admin.module.detail.add',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postModuleAdd($table){
		if (isset($_POST['submit'])) {
			$user = new AdminModel();
			$module_detail = $user->getFirstRowWhere('module',['table_name' => $table]);
			$data = $user->getData($table,[]);
			foreach(json_decode($module_detail->fields) as $key => $items){
				if(isset($_POST[$items->name])){
					$arr[$items->name] = $_POST[$items->name];
					if($arr[$items->name] == 'on'){
						$arr[$items->name] = 1;
					}
				}elseif(isset($_FILES[$items->name])){
					$arr[$items->name] = 'public/upload/'.$table.'/'.time().$_FILES[$items->name]['name'];
					$tmp_name = $_FILES[$items->name]['tmp_name'];
					if(!is_dir('public/upload/'.$table)){
						mkdir('public/upload/'.$table);
					}
					if(!file_exists($arr[$items->name])){
						Image::make($tmp_name)->save($arr[$items->name]);
					}
				}else{
					$arr[$items->name] = "";
				}
			}
			$user->insertData($table,$arr);
			return redirect(url('admin/module/'.$table));
		}
	}
	public function getModuleEdit($table,$id){
		if(Session::has('user') && Session::get('user')->site_option == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$data['module_detail'] = $user->getFirstRowWhere('module',['table_name' => $table]);
			$data['data'] = $user->getData($table,[]);
			$data['get_old'] = $user->getFirstRowWhere($table,['id' => $id]);
			// dd($data['get_old']);
			return view('admin.module.detail.edit',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postModuleEdit($table,$id){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$module_detail = $user->getFirstRowWhere('module',['table_name' => $table]);
			$data = $user->getData($table,[]);
			$get_old = $user->getFirstRowWhere($table,['id' => $id]);
			foreach(json_decode($module_detail->fields) as $key => $items){
				$name = $items->name;
				if(isset($_POST[$items->name])){
					$arr[$items->name] = $_POST[$items->name];
					if($arr[$items->name] == 'on'){
						$arr[$items->name] = 1;
					}
				}elseif(isset($_FILES[$items->name])){
					if($_FILES[$items->name] == ""){
						$arr[$items->name] = $get_old->$name;
					}else{
						$arr[$items->name] = 'public/upload/'.$table.'/'.time().$_FILES[$items->name]['name'];
						$tmp_name = $_FILES[$items->name]['tmp_name'];
						if(!is_dir('public/upload/'.$table)){
							mkdir('public/upload/'.$table);
						}
						if(file_exists($get_old->$name)){
							unlink($get_old->$name);
						}
						if(!file_exists($arr[$items->name])){
							Image::make($tmp_name)->save($arr[$items->name]);
						}
					}
					
				}else{
					$arr[$items->name] = "";
				}
			}
			$user->updateData($table,['id' => $id],$arr);
			return redirect(url('admin/module/'.$table));
		}
	}
	public function moduleDel($table,$id){
		if(Session::has('user') && Session::get('user')->site_option == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$module_detail = $user->getFirstRowWhere('module',['table_name' => $table]);
			$get_old = $user->getFirstRowWhere($table,['id' => $id]);
			foreach(json_decode($module_detail->fields) as $key => $items){
				if($items->display_type == 5){
					$name = $items->name;
					if(file_exists($get_old->$name)){
						unlink($get_old->$name);
					}
				}
			}
			Session::flash('success','Xóa thành công');
			$user->deleteData($table,['id' => $id]);
			return redirect(url('admin/module/'.$table));
		}else{
			return redirect('admin');
		}
	}
	public function generateDB(){
		if(Schema::hasTable('module')){
			$module = DB::table('module')->get();
			$user = new AdminModel();
			foreach ($module as $value) {
				if($value->id > 10){
					$table_name = $value->table_name;
					$_POST['column'] = $value->column;
					$column = $_POST['column'];
					foreach(json_decode($value->fields) as $key => $items){
						$str_name = 'name'.$key;
						$_POST[$str_name] = $items->name;
						$str_type = 'type'.$key;
						$_POST[$str_type] = $items->type;
						$str_length = 'length'.$key;
						$_POST[$str_length] = $items->length;
					}
					if (!Schema::hasTable($value->table_name)) {
						Schema::create($table_name, function(Blueprint $table){
							$column = $_POST['column'];
							$table->increments('id');
							for($i=1;$i<=$column;$i++){
								$str_name = 'name'.$i;
								$name[$i] = $_POST[$str_name];
								$str_type = 'type'.$i;
								$type[$i] = $_POST[$str_type];
								$str_length = 'length'.$i;
								$length[$i] = $_POST[$str_length];
								if($type[$i] == 0 || $type[$i] == 3){
									$table->text($name[$i]);
								}elseif($type[$i] == 1){
									$table->biginteger($name[$i])->length($length[$i])->unsigned();
								}elseif($type[$i] == 2){
									$table->string($name[$i],$length[$i]);
								}elseif($type[$i] == 4){
									$table->date($name[$i]);
								}
							}

						});
					}
					if(!is_dir('public/upload/'.$table_name)){
						mkdir('public/upload/'.$table_name);
					}
				}
			}
		}
		return redirect('admin');
	}

}
