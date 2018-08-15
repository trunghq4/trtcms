<?php namespace App\Http\Controllers\admin\news;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,DB,Helper,Schema;
use Illuminate\Http\Request;

class CategoryNewsController extends Controller {

	public function index(){
		if (Session::has('user') && Session::get('user')->news_cate == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['list_cate'] = $user->getData('category',['lang' => Session::get('lang')]);
			return view('admin.news.listcate',$data);
		}else{
			return redirect('admin');
		}
	}
	public function getadd(){
		if (Session::has('user') && Session::get('user')->add_news_cate == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['list_cate'] = $user->getData('category',['lang' => Session::get('lang')]);
			return view('admin.news.addcate',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postadd(){
		$user = new AdminModel();
		if(isset($_POST['submit'])){
			$title = $_POST['title'];
			$check_name = $user->countData('category',['title' => $title]);
			if($check_name > 0){
				Session::flash('error','Tên danh mục đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				if($_POST['alias'] != ""){
					$alias = $_POST['alias'];
				}else{
					$alias = Helper::make_alias($title);
				}
				$check_alias = $user->countData('alias',['alias' => $alias]);
				if($check_alias > 0){
					Session::flash('error','Đường dẫn đã tồn tại');
					return redirect()->back()->withInput();
				}else{
					$description = $_POST['description'];
					$parent_id = $_POST['parent_id'];
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
					if($_POST['keyword_seo'] == ""){
						$keyword_seo = $title;
					}else{
						$keyword_seo = $_POST['keyword_seo'];
					}
					if(isset($_POST['home'])){
						$home = 1;
					}else{
						$home = 0;
					}
					if(isset($_POST['focus'])){
						$focus = 1;
					}else{
						$focus = 0;
					}
					if(isset($_POST['hot'])){
						$hot = 1;
					}else{
						$hot = 0;
					}
					if($_FILES['image']['name'] != ""){
						$get_ext = explode('.',$_FILES['image']['name']);
						$ext = '.'.end($get_ext);
						$image = 'public/upload/catenews/'.time().$ext;
						$tmp_name = $_FILES['image']['tmp_name'];
						if(!file_exists($image)){
							Image::make($tmp_name)->save($image);
						}
						$thumb = 'public/upload/catenews/thumb/'.time().$ext;
						if(!file_exists($thumb)){
							Image::make($image)->fit(300, 180)->save($thumb);
						}
					}else{
						$image = "";
						$thumb = "";
					}
					$arr1 = [
						'title' => $title,
						'alias' => $alias,
						'description' => $description,
						'description_seo' => $description_seo,
						'title_seo' => $title_seo,
						'keyword_seo' => $keyword_seo,
						'parent_id' => $parent_id,
						'home' => $home,
						'hot' => $hot,
						'focus' => $focus,
						'image' => $image,
						'thumb' => $thumb,
						'lang' => Session::get('lang'),
						'time' => time(),
					];
					$user->insertData('category',$arr1);
					$get_news = $user->getFirstRowWhere('category',['title'=>$title]);
					$arr2 = [
						'alias' => $alias,
						'type' => 'catenews',
						'news_cate' => $get_news->id
					];
					$user->insertData('alias',$arr2);
					return redirect('admin/list-news-category');
				}
			}
		}
	}
	public function del($id){
		if(Session::has('user') && Session::get('user')->edit_news_cate == 1 && $id != 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('category',['id'=>$id]);
			if(file_exists(url($get_old->image))){
				unlink(url($get_old->image));
			}
			if (file_exists(url($get_old->thumb))) {
				unlink(url($get_old->thumb));
			}
			$user->deleteData('alias',['alias' => $get_old->alias]);
			$user->deleteData('category',['id' => $id]);
			$get_news = $user->getData('news_to_category',['id_category' => $get_old->id]);
			$user->deleteData('news_to_category',['id_category' => $id]);
			foreach($get_news as $items){
				$check = $user->countData('news_to_category',['id_news' => $items->id_news]);
				if($check == 0){
					$user->insertData('news_to_category',[
						'id_news' => $items->id_news,
						'id_category' => 1,
					]);
					$user->updateData('news',['category_id' => $id],['category_id' => 1]);
				}else{
					$update_news = $user->getFirstRowWhere('news_to_category',['id_news' => $items->id_news]);
					$user->updateData('news',['category_id' => $id],['category_id' => $update_news->id_category]);
				}
			}
			Session::flash('success','Xóa danh mục thành công!');
			return redirect('admin/list-news-category');
		}else{
			return redirect('admin');
		}
	}
	public function getedit($id){
		if(Session::has('user') && Session::get('user')->edit_news_cate == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$data['get_old'] = $user->getFirstRowWhere('category',['id'=>$id]);
			$data['list_cate'] = $user->getData('category',['lang' => Session::get('lang')]);
			return view('admin.news.editcate',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postedit($id){
		$user = new AdminModel();
		$get_old = $user->getFirstRowWhere('category',['id' => $id]);
		$get_old_alias = $user->getFirstRowWhere('alias',['alias' => $get_old->alias]);
		$title = $_POST['title'];
		$check_name = DB::table('category')->where('title',$title)->where('id','!=',$id)->count();
		if($check_name > 0){
			Session::flash('error','Tiêu đề đã tồn tại');
			return redirect()->back()->withInput();
		}else{
			if($_POST['alias'] != ""){
				$alias = $_POST['alias'];
			}else{
				$alias = Helper::make_alias($title);
			}
			$check_alias = DB::table('alias')->where('alias',$alias)->where('id','!=',$get_old_alias->id)->count();
			if($check_alias >0){
				Session::flash('error','Đường dẫn đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				$description = $_POST['description'];
				$parent_id = $_POST['parent_id'];
				$time = time();
				if($_POST['title_seo'] != ""){
					$title_seo = $_POST['title_seo'];
				}else{
					$title_seo = $title;
				}
				if($_POST['description_seo'] != ""){
					$description_seo = $_POST['description_seo'];
				}else{
					$description_seo = $title;
				}
				if($_POST['keyword_seo'] != ""){
					$keyword_seo = $_POST['keyword_seo'];
				}else{
					$keyword_seo = $title;
				}
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
				if($_FILES['image']['name'] != ''){
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					$get_ext = explode('.',$_FILES['image']['name']);
					$ext = '.'.end($get_ext);
					$image = 'public/upload/catenews/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/catenews/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						Image::make($image)->fit(300, 180)->save($thumb);
					}
				}else{
					$image = $get_old->image;
					$thumb = $get_old->thumb;
				}
				$arr1 = [
					'title' => $title,
					'description' => $description,
					'description_seo' => $description_seo,
					'title_seo' => $title_seo,
					'keyword_seo' => $keyword_seo,
					'parent_id' => $parent_id,
					'alias' => $alias,
					'time' => $time,
					'home' => $home,
					'hot' => $hot,
					'focus' => $focus,
					'image' => $image,
					'thumb' => $thumb,
				];
				$user->updateData('category',['id' => $id],$arr1);
				$get_news = $user->getFirstRowWhere('category',['id' => $id]);
				$user->updateData('alias',['news_cate' => $id],['alias' => $alias]);
				Session::flash('success','Sửa danh mục thành công');
				return redirect('admin/list-news-category');
			}
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$category = $_POST['check_del'];
				$count = count($category);
				for($i=0;$i<$count;$i++){
					$id = $category[$i];
					$get_old = $user->getFirstRowWhere('category',['id'=>$id]);
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					$user->deleteData('category',['id'=>$id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
					$get_news = $user->getData('news_to_category',['id_category' => $get_old->id]);
					$user->deleteData('news_to_category',['id_category' => $get_old->id]);
					foreach($get_news as $items){
						$check = $user->countData('news_to_category',['id_news' => $items->id_news]);
						if($check == 0){
							$user->insertData('news_to_category',['id_news' => $items->id_news, 'id_category' => 1]);
							$user->updateData('news',['category_id' => $id],['category_id' => 1]);
						}else{
							$update_news = $user->getFirstRowWhere('news_to_category',['id_news' => $items->id_news]);
							$user->updateData('news',['category_id' => $id],['category_id' => $update_news->id_category]);
						}
					}
					
				}
				Session::flash('success','Xóa danh mục thành công');
				return redirect('admin/list-news-category');
			}else{
				return redirect('admin/list-news-category');
			}
		}
	}
}
