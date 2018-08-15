<?php namespace App\Http\Controllers\admin\page;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,DB,Helper,Schema;
use Illuminate\Http\Request;

class PageController extends Controller {

	public function index(){
		if(!Session::has('user') || Session::get('user')->page != 1 || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$data['list_page'] = $user->getData('pages',['lang' => Session::get('lang')],'id','desc	');
			return view('admin.page.listpage',$data);
		}
	}
	public function getadd(){
		if(!Session::has('user') || Session::get('user')->page != 1 || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			return view('admin.page.addpage');
		}
	}
	public function postadd(){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$title = $_POST['title'];
			$check_name = $user->countData('pages',['title' => $title]);
			if($check_name>0){
				Session::flash('error','Tiêu đề đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				$alias = $_POST['alias'];
				$check_alias = $user->countData('alias',['alias' => $alias]);
				if($check_alias > 0){
					Session::flash('error','Đường dẫn đã tồn tại');
					return redirect()->back()->withInput();
				}else{
					if($_POST['title_seo'] == ""){
						$title_seo = $title;
					}else{
						$title_seo = $_POST['title_seo'];
					}
					if($_POST['description_seo'] == ""){
						$description_seo = $title;
					}else{
						$description_seo = $_POST['description_seo'];
					}
					$keyword_seo = $_POST['keyword_seo'];
					$description = $_POST['description'];
					$content = $_POST['content'];
					$user_id = Session::get('user')->id;
					$time = time();
					if(isset($_POST['home'])){
						$home = 1;
					}else{
						$home = 0;
					}
					if(isset($_POST['hot'])){
						$hot = 1;
					}else{
						$hot = 0;
					}
					if(isset($_POST['focus'])){
						$focus = 1;
					}else{
						$focus = 0;
					}
					if(isset($_POST['view_count'])){
						$view_count = $_POST['view_count'];
					}else{
						$view_count = 0;
					}
					$lang = Session::get('lang');
					if($_FILES['image']['name'] != ''){
						$get_ext = explode('.',$_FILES['image']['name']);
						$ext = '.'.end($get_ext);
						$image = 'public/upload/page/'.time().$ext;
						$tmp_name = $_FILES['image']['tmp_name'];
						if(!file_exists($image)){
							Image::make($tmp_name)->save($image);
						}
						$thumb = 'public/upload/page/thumb/'.time().$ext;
						if(!file_exists($thumb)){
							Image::make($image)->fit(300, 180)->save($thumb);
						}
					}else{
						$image = "";
						$thumb = "";
					}
					$arr = [
						'title' => $title,
						'alias' => $alias,
						'description' => $description,
						'content' => $content,
						'user_id' => $user_id,
						'title_seo' => $title_seo,
						'description_seo' => $description_seo,
						'keyword_seo' => $keyword_seo,
						'image' => $image,
						'thumb' => $thumb,
						'hot' => $hot,
						'home' => $home,
						'focus' => $focus,
						'time' => $time,
						'view_count' => $view_count,
						'lang' => $lang,
					];
					$user->insertData('pages',$arr);
					$get_new = $user->getFirstRowWhere('pages',['title' => $title]);
					$user->insertData('alias',['alias' => $alias, 'type' => 'page', 'page' => $get_new->id]);
					Session::flash('success','Thêm bài viết thành công');
					return redirect(url('admin/list-page'));
				}
			}
		}
	}
	public function getedit($id){
		if(!Session::has('user') || Session::get('user')->page != 1 || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$data['get_old'] = $user->getFirstRowWhere('pages',['id' => $id]);
			return view('admin.page.editpage',$data);
		}
	}
	public function postedit($id){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('pages',['id' => $id]);
			$get_old_alias = $user->getFirstRowWhere('alias',['page' => $id]);
			$title = $_POST['title'];
			$check_name = DB::table('pages')->where('title',$title)->where('id','!=',$id)->count();
			if($check_name >0){
				Session::flash('error','Tiêu đề bài viết đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				$alias = $_POST['alias'];
				$check_alias = DB::table('alias')->where('alias',$alias)->where('id','!=',$get_old_alias->id)->count();
				if($check_alias > 0){
					Session::flash('error','Đường dẫn đã tồn tại');
					return redirect()->back()->withInput();
				}else{
					if($_POST['title_seo'] == ""){
						$title_seo = $title;
					}else{
						$title_seo = $_POST['title_seo'];
					}
					if($_POST['description_seo'] == ""){
						$description_seo = $title;
					}else{
						$description_seo = $_POST['description_seo'];
					}
					$keyword_seo = $_POST['keyword_seo'];
					$description = $_POST['description'];
					$content = $_POST['content'];
					$user_id = Session::get('user')->id;
					$time = time();
					if(isset($_POST['home'])){
						$home = 1;
					}else{
						$home = 0;
					}
					if(isset($_POST['hot'])){
						$hot = 1;
					}else{
						$hot = 0;
					}
					if(isset($_POST['focus'])){
						$focus = 1;
					}else{
						$focus = 0;
					}
					if(isset($_POST['view_count'])){
						$view_count = $_POST['view_count'];
					}else{
						$view_count = 0;
					}
					$lang = Session::get('lang');
					if($_FILES['image']['name'] != ''){
						if(file_exists($get_old->image)){
							unlink($get_old->image);
						}
						if(file_exists($get_old->thumb)){
							unlink($get_old->thumb);
						}
						$get_ext = explode('.',$_FILES['image']['name']);
						$ext = '.'.end($get_ext);
						$image = 'public/upload/page/'.time().$ext;
						$tmp_name = $_FILES['image']['tmp_name'];
						if(!file_exists($image)){
							Image::make($tmp_name)->save($image);
						}
						$thumb = 'public/upload/page/thumb/'.time().$ext;
						if(!file_exists($thumb)){
							Image::make($image)->fit(300, 180)->save($thumb);
						}
					}else{
						$image = $get_old->image;
						$thumb = $get_old->thumb;
					}
					$arr = [
						'title' => $title,
						'alias' => $alias,
						'description' => $description,
						'content' => $content,
						'user_id' => $user_id,
						'title_seo' => $title_seo,
						'description_seo' => $description_seo,
						'keyword_seo' => $keyword_seo,
						'image' => $image,
						'thumb' => $thumb,
						'hot' => $hot,
						'home' => $home,
						'focus' => $focus,
						'time' => $time,
						'view_count' => $view_count,
						'lang' => $lang,
					];
					$user->updateData('pages',['id' => $id],$arr);
					$user->updateData('alias',['page' => $id],['alias' => $alias]);
					Session::flash('success','Sửa bài viết thành công');
					return redirect('admin/list-page');
				}
			}
		}
	}
	public function del($id){
		if(!Session::has('user') || Session::get('user')->page != 1 || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('pages',['id' => $id]);
			if(file_exists($get_old->image)){
				unlink($get_old->image);
			}
			if(file_exists($get_old->thumb)){
				unlink($get_old->thumb);
			}
			$user->deleteData('pages',['id' => $id]);
			$user->deleteData('alias',['page' => $id]);
			Session::flash('success','Xóa bài viết thành công');
			return redirect('admin/list-page');
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$page = $_POST['check_del'];
				$count = count($page);
				for($i=0;$i<$count;$i++){
					$id = $page[$i];
					$get_old = $user->getFirstRowWhere('pages',['id'=>$id]);
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					$user->deleteData('pages',['id'=>$id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
				}
				return redirect('admin/list-page');
			}else{
				return redirect('admin/list-page');
			}
		}
	}

}
