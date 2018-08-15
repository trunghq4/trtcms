<?php namespace App\Http\Controllers\admin\menu;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,DB,Image,Helper,Schema;
use Illuminate\Http\Request;

class MenuController extends Controller {

	public function index(){
		if(Session::has('user') && Session::get('user')->menu == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$where = ['lang' => Session::get('lang')];
			$list_procate = $user->getData('product_category',$where);
			$list_newscate = $user->getData('category',$where);
			$pages = $user->getData('pages',$where);
			if(!Session::has('menu_position')){
				Session::put('menu_position','top');
			}
			$data['menu'] = DB::table('menu')->orderby('sort','asc')->orderby('id','asc')->where(['lang' => Session::get('lang'),'position' => Session::get('menu_position')])->get();
			return view('admin.menu.menu',$data);
		}else{
			return redirect('admin');
		}
	}
	public function listchangePosition($position){
		if(Session::has('user') && Session::get('user')->menu == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$where = ['lang' => Session::get('lang')];
			$list_procate = $user->getData('product_category',$where);
			$list_newscate = $user->getData('category',$where);
			$pages = $user->getData('pages',$where);
			Session::put('menu_position',$position);
			return redirect('admin/list-menu');
		}else{
			return redirect('admin');
		}
	}
	public function getadd(){
		if(Session::has('user') && Session::get('user')->menu == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$where = ['lang' => Session::get('lang')];
			$data['list_procate'] = $user->getData('product_category',$where);
			$data['list_newscate'] = $user->getData('category',$where);
			$data['pages'] = $user->getData('pages',$where);
			$data['menu'] = $user->getData('menu',['lang' => Session::get('lang'),'position' => Session::get('menu_position')]);
			return view('admin.menu.add',$data);
		}else{
			return redirect('admin');
		}
	}
	public function changePosition($position){
		if(Session::has('user') && Session::get('user')->menu == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$where = ['lang' => Session::get('lang')];
			$data['list_procate'] = $user->getData('product_category',$where);
			$data['list_newscate'] = $user->getData('category',$where);
			$data['pages'] = $user->getData('pages',$where);
			Session::put('menu_position',$position);
			return redirect('admin/add-menu');
		}else{
			return redirect('admin');
		}
	}
	public function postadd(){
		$user = new AdminModel();
		$where = ['lang' => Session::get('lang')];
		$data['list_procate'] = $user->getData('product_category',$where);
		$data['list_newscate'] = $user->getData('category',$where);
		$data['pages'] = $user->getData('pages',$where);
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			if(isset($_POST['home'])){
				$home = 1;
			}else{
				$home = 0;
			}
			$position = $_POST['position'];
			$parent_id = $_POST['parent_id'];
			$description = $_POST['description'];
			$module = $_POST['module'];
			$news_cate = $_POST['news_cate'];
			$product_cate = $_POST['product_cate'];
			$page = $_POST['page'];
			$url = $_POST['url'];
			if($module == 'news_cate'){
				$get_url = $user->getFirstRowWhere('category',['id' => $news_cate]);
				$url = $get_url->alias;
			}elseif($module == 'product_cate'){
				$get_url = $user->getFirstRowWhere('product_category',['id' => $product_cate]);
				$url = $get_url->alias;
			}elseif($module == 'page'){
				$get_url = $user->getFirstRowWhere('pages',['id' => $page]);
				$url = $get_url->alias;
			}else{
				$url = $_POST['url'];
			}
			if($_FILES['image']['name'] != ""){
				$get_ext = explode('.',$_FILES['image']['name']);
				$ext = '.'.end($get_ext);
				$icon = 'public/upload/menu/'.time().$ext;
				$tmp_name = $_FILES['image']['tmp_name'];
				if(!file_exists($icon)){
					Image::make($tmp_name)->save($icon);
				}
			}else{
				$icon = "";
			}
			$arr = [
				'name' => $name,
				'url' => $url,
				'position' => $position,
				'icon' => $icon,
				'parent_id' => $parent_id,
				'description' => $description,
				'module' => $module,
				'product_cate' => $product_cate,
				'news_cate' => $news_cate,
				'page' => $page,
				'home' => $home,
				'lang' => Session::get('lang'),
			];
			$user->insertData('menu',$arr);
			$new = $user->getFirstRowWhere('menu',$arr);
			$user->updateData('menu',['id' => $new->id],['sort' => $new->id]);
			return redirect('admin/list-menu');
		}
	}
	public function getedit($id){
		if(Session::has('user') && Session::get('user')->menu == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$where = ['lang' => Session::get('lang')];
			$data['list_procate'] = $user->getData('product_category',$where);
			$data['list_newscate'] = $user->getData('category',$where);
			$data['pages'] = $user->getData('pages',$where);
			$data['get_old'] = $user->getFirstRowWhere('menu',['id' => $id]);
			$data['menu'] = $user->getData('menu',['lang' => Session::get('lang'),'position' => Session::get('menu_position')]);
			return view('admin.menu.edit',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postedit($id){
		$user = new AdminModel();
		$where = ['lang' => Session::get('lang')];
		$data['list_procate'] = $user->getData('product_category',$where);
		$data['list_newscate'] = $user->getData('category',$where);
		$data['pages'] = $user->getData('pages',$where);
		$get_old = $user->getFirstRowWhere('menu',['id' => $id]);
		$name = $_POST['name'];
		$position = $_POST['position'];
		$parent_id = $_POST['parent_id'];
		$description = $_POST['description'];
		$module = $_POST['module'];
		$news_cate = $_POST['news_cate'];
		$product_cate = $_POST['product_cate'];
		$page = $_POST['page'];
		$url = $_POST['url'];
		if($module == 'news_cate'){
			$product_cate = 0;
			$page = 0;
			$get_url = $user->getFirstRowWhere('category',['id' => $news_cate]);
			$url = $get_url->alias;
		}elseif($module == 'product_cate'){
			$news_cate = 0;
			$page = 0;
			$get_url = $user->getFirstRowWhere('product_category',['id' => $product_cate]);
			$url = $get_url->alias;
		}elseif($module == 'page'){
			$product_cate = 0;
			$news_cate = 0;
			$get_url = $user->getFirstRowWhere('pages',['id' => $page]);
			$url = $get_url->alias;
		}else{
			$url = $_POST['url'];
		}
		if($_FILES['image']['name'] != ""){
			if(file_exists($get_old->icon)){
				unlink($get_old->icon);
			}
			$get_ext = explode('.',$_FILES['image']['name']);
			$ext = '.'.end($get_ext);
			$icon = 'public/upload/menu/'.time().$ext;
			$tmp_name = $_FILES['image']['tmp_name'];
			if(!file_exists($icon)){
				Image::make($tmp_name)->save($icon);
			}
		}else{
			$icon = $get_old->icon;
		}
		if(isset($_POST['home'])){
			$home = 1;
		}else{
			$home = 0;
		}
		$arr = [
			'name' => $name,
			'url' => $url,
			'position' => $position,
			'icon' => $icon,
			'parent_id' => $parent_id,
			'description' => $description,
			'module' => $module,
			'product_cate' => $product_cate,
			'news_cate' => $news_cate,
			'page' => $page,
			'home' => $home,
			'lang' => Session::get('lang'),
		];
		$user->updateData('menu',['id' => $id],$arr);
		Session::flash('success','Sửa menu thành công');
		return redirect(url('admin/list-menu'));

	}
	public function del($id){
		$user = new AdminModel();
		$where = ['lang' => Session::get('lang')];
		$data['list_procate'] = $user->getData('product_category',$where);
		$data['list_newscate'] = $user->getData('category',$where);
		$data['pages'] = $user->getData('pages',$where);
		if(Session::has('user') && Session::get('user')->menu == 1 && Schema::hasTable('user')){
			$get_old = $user->getFirstRowWhere('menu',['id' => $id]);
			if (file_exists($get_old->icon)) {
				unlink($get_old->icon);
			}
			$user->deleteData('menu',['parent_id' => $id]);
			$user->deleteData('menu',['id' => $id]);
			Session::flash('success','Xóa menu thành công');
			return redirect('admin/list-menu');
		}else{
			return redirect('admin');
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			$where = ['lang' => Session::get('lang')];
			$data['list_procate'] = $user->getData('product_category',$where);
			$data['list_newscate'] = $user->getData('category',$where);
			$data['pages'] = $user->getData('pages',$where);
			if(isset($_POST['check_del'])){
				$news = $_POST['check_del'];
				$count = count($news);
				for($i=0;$i<$count;$i++){
					$id = $news[$i];
					$get_old = $user->getFirstRowWhere('menu',['id'=>$id]);
					if(!empty($get_old)){
						if(file_exists($get_old->icon)){
							unlink($get_old->icon);
						}
						$user->deleteData('menu',['id'=>$id]);
						$user->deleteData('menu',['parent_id'=>$id]);
					}
				}
				return redirect('admin/list-menu');
			}else{
				return redirect('admin/list-menu');
			}
		}
	}

}
