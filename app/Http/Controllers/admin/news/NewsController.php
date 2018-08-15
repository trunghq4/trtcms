<?php namespace App\Http\Controllers\admin\news;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,DB,Helper,Schema;
use Illuminate\Http\Request;

class NewsController extends Controller {

	public function index(){
		$user = new AdminModel();
		if (Session::has('user') && Session::get('user')->news == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['cate_news'] = $user->getData('category',['lang'=>Session::get('lang')]);
			$data['list_user'] = $user->getData('user',[]);
			$data['list_news'] = $user->getAllNews();
			return view('admin.news.listnews',$data);
		}else{
			return redirect('admin');
		}
	}
	public function getadd(){
		if (Session::has('user') && Session::get('user')->add_news == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['cate_news'] = $user->getData('category',['lang'=>Session::get('lang')]);
			return view('admin.news.addnews',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postadd(){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$site_option = $user->site_option();
			$title = $_POST['title'];
			$check_name = $user->countData('news',['title' => $title]);
			if($check_name > 0){
				Session::flash('error','Tiêu đề bài viết đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				if($_POST['alias'] == ''){
					$alias = Helper::make_alias($_POST['title']);
				}else{
					$alias = $_POST['alias'];
				}
				$check_alias = $user->countData('alias',['alias' => $alias]);
				if($check_alias >0){
					Session::flash('error','Đường dẫn đã tồn tại');
					return redirect()->back()->withInput();
				}else{
					if($_POST['title_seo'] == ''){
						$title_seo = $title;
					}else{
						$title_seo = $_POST['title_seo'];
					}
					if($_POST['description_seo'] == ''){
						$description_seo = $title;
					}else{
						$description_seo = $_POST['description_seo'];
					}
					if($_POST['keyword_seo'] == ''){
						$keyword_seo = $title;
					}else{
						$keyword_seo = $_POST['keyword_seo'];
					}
					$category_id = end($_POST['category_id']);
					$user_id = Session::get('user')->id;
					$time = time();
					if(isset($_POST['publish'])){
						$publish = 1;
					}else{
						$publish = 0;
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
					if(isset($_POST['view_count'])){
						$view_count = $_POST['view_count'];
					}else{
						$view_count = 0;
					}

					$description = $_POST['description'];
					$content = $_POST['content'];
					if($_FILES['image']['name'] != ''){
						$get_ext = explode('.',$_FILES['image']['name']);
						$ext = '.'.end($get_ext);
						$image = 'public/upload/news/'.time().$ext;
						$tmp_name = $_FILES['image']['tmp_name'];
						if(!file_exists($image)){
							Image::make($tmp_name)->save($image);
						}
						$thumb = 'public/upload/news/thumb/'.time().$ext;
						if(!file_exists($thumb)){
							if (isset($_POST['watermark'])) {
								Image::make($image)->fit(448, 250)->insert($site_option->watermark)->save($thumb);
							}else{
								Image::make($image)->fit(448, 250)->save($thumb);
							}
							
						}
					}else{
						$image = "";
						$thumb = "";
					}
					$arr1 = [
						'title' => $title,
						'alias' => $alias,
						'description' => $description,
						'image' => $image,
						'thumb' => $thumb,
						'content' => $content,
						'category_id' => $category_id,
						'user_id' => $user_id,
						'tags' => json_encode(explode(',',$_POST['tags'])),
						'time' => $time,
						'view_count' => $view_count,
						'title_seo' => $title_seo,
						'description_seo' => $description_seo,
						'keyword_seo' => $keyword_seo,
						'publish' => $publish,
						'hot' => $hot,
						'home' => $home,
						'focus' => $focus,
						'lang' => Session::get('lang')
					];
					$user->insertData('news',$arr1);
					$get_new = $user->getFirstRowWhere('news',['title' => $title]);
					if($_POST['tags'] != ""){
						foreach(explode(',',$_POST['tags']) as $items){
							$tags_alias = Helper::make_alias(trim($items));
							$check_alias_tags = $user->countData('tags',['alias' => $tags_alias,'id_news' => $get_new->id]);
							if($check_alias_tags == 0){
								$arr = [
									'name' => $items,
									'alias' => $tags_alias,
									'id_news' => $get_new->id,
									'lang' => Session::get('lang'),
								];
								$user->insertData('tags',$arr);
							}
						}
					}
					$arr2 = [
						'alias' => $alias,
						'type' => 'news',
						'news' => $get_new->id,
					];
					$user->insertData('alias',$arr2);
					for($i=0;$i<count($_POST['category_id']);$i++){
						$arr3 = [
							'id_news' => $get_new->id,
							'id_category' => $_POST['category_id'][$i],
						];
						$user->insertData('news_to_category',$arr3);
					}
					Session::flash('success','Thêm mới thành công');
					return redirect('admin/list-news');
				}
			}
		}
	}
	public function del($id){
		if (Session::has('user') && Session::get('user')->edit_news == 0 && Schema::hasTable('user')) {
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('news',['id'=>$id]);
			if(file_exists($get_old->image)){
				unlink($get_old->image);
			}
			if(file_exists($get_old->thumb)){
				unlink($get_old->thumb);
			}
			$user->deleteData('news',['id' => $id]);
			$user->deleteData('alias',['news' => $id]);
			$user->deleteData('tags',['id_news' => $id]);
			$user->deleteData('news_to_category',['id_news' => $id]);
			Session::flash('success','Xóa bài viết thành công');
			return redirect('admin/list-news');
		}
	}
	public function getedit($id){
		if(!Session::has('user') || !Session::get('user')->edit_news == 1 || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$data['get_old'] = $user->getFirstRowWhere('news',['id' => $id]);
			$data['cate_news']= $user->getData('category',['lang' => Session::get('lang')]);
			return view('admin.news.editnews',$data);
		}
	}
	public function postedit($id){
		$user = new AdminModel();
		$site_option = $user->site_option();
		$get_old = $user->getFirstRowWhere('news',['id' => $id]);
		$get_old_alias = $user->getFirstRowWhere('alias',['alias' => $get_old->alias]);
		$title = $_POST['title'];
		$check_name = DB::table('news')->where('id','!=',$id)->where('title',$title)->count();
		if($check_name > 0){
			Session::flash('error','Tiêu đề bài viết đã tồn tại');
			return redirect()->back()->withInput();
		}else{
			$alias = $_POST['alias'];
			$check_alias = DB::table('alias')->where('alias',$alias)->where('id','!=',$get_old_alias->id)->count();
			if($check_alias > 0){
				Session::flash('error','Đường dẫn đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				$description = $_POST['description'];
				$category_id = end($_POST['category_id']);
				if($_POST['title_seo'] != ''){
					$title_seo = $_POST['title_seo'];
				}
				else{
					$title_seo = $title;
				}
				if($_POST['description_seo'] != ''){
					$description_seo = $_POST['description_seo'];
				}
				else{
					$description_seo = $title;
				}
				if($_POST['keyword_seo'] != ''){
					$keyword_seo = $_POST['keyword_seo'];
				}
				else{
					$keyword_seo = $title;
				}
				$content = $_POST['content'];
				if(isset($_POST['publish'])){
					$publish = 1;
				}else{
					$publish = 0;
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
				if(isset($_POST['view_count'])){
					$view_count = $_POST['view_count'];
				}else{
					$view_count = 0;
				}
				if($_FILES['image']['name'] == ''){
					$image = $get_old->image;
					$thumb = $get_old->thumb;
					if (isset($_POST['watermark'])) {
						Image::make($get_old->thumb)->insert($site_option->watermark)->save($get_old->thumb);
					}
				}else{
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					$get_ext = explode('.',$_FILES['image']['name']);
					$ext = '.'.end($get_ext);
					$image = 'public/upload/news/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/news/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						if (isset($_POST['watermark'])) {
							Image::make($image)->fit(448, 250)->insert($site_option->watermark)->save($thumb);
						}else{
							Image::make($image)->fit(448, 250)->save($thumb);
						}
					}
				}
				$arr1 = [
					'title' => $title,
					'category_id' => $category_id,
					'alias' => $alias,
					'description' => $description,
					'title_seo' => $title_seo,
					'keyword_seo' => $keyword_seo,
					'description_seo' => $description_seo,
					'tags' => json_encode(explode(',',$_POST['tags'])),
					'time' => time(),
					'view_count' => $view_count,
					'hot' => $hot,
					'publish' => $publish,
					'home' => $home,
					'focus' => $focus,
					'image' => $image,
					'thumb' => $thumb,
					'content' => $content,
				];
				$user->updateData('news',['id'=>$id],$arr1);
				$user->updateData('alias',['id'=>$get_old_alias->id],['alias' => $alias]);
				$user->deleteData('tags',['id_news'=>$id]);
				$user->deleteData('news_to_category',['id_news'=>$get_old->id]);
				for($i=0;$i<count($_POST['category_id']);$i++){
					$user->insertData('news_to_category',[
						'id_news' => $get_old->id,
						'id_category' => $_POST['category_id'][$i],
					]);
				}
				if($_POST['tags'] != ""){
					foreach(explode(',',$_POST['tags']) as $items){
						$tags_alias = Helper::make_alias(trim($items));
						$check_alias_tags = $user->countData('tags',['alias' => $tags_alias,'id_news' => $id]);
						if($check_alias_tags == 0){
							$arr = [
								'name' => $items,
								'alias' => $tags_alias,
								'id_news' => $id,
								'lang' => Session::get('lang'),
							];
							$user->insertData('tags',$arr);
						}
					}
				}
				Session::flash('success','Sửa bài viết thành công');
				return redirect('admin/list-news');
			}
		}

	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$news = $_POST['check_del'];
				$count = count($news);
				for($i=0;$i<$count;$i++){
					$id = $news[$i];
					$get_old = $user->getFirstRowWhere('news',['id'=>$id]);
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					$user->deleteData('news',['id'=>$id]);
					$user->deleteData('news_to_category',['id_news'=>$id]);
					$user->deleteData('tags',['id_news' => $id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
				}
				return redirect('admin/list-news');
			}else{
				return redirect('admin/list-news');
			}
		}
	}
	public function searchByCate($id){
		if (Session::has('user') && Session::get('user')->news == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['list_news'] = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->join('news_to_category','news.id','=','news_to_category.id_news')
			->join('user','news.user_id','=','user.id')
			->select('news.*','category.parent_id','category.title as cate_title','user.name as user_name')
			->where('news_to_category.id_category',$id)
			->paginate(10);
			$data['list_user'] = $user->getData('user',[]);
			$data['cate_news'] = $user->getData('category',['lang'=>Session::get('lang')]);
			return view('admin/news/search',$data);
		}else{
			return redirect('admin');
		}
	}
	public function searchByUser($id){
		if (Session::has('user') && Session::get('user')->news == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['list_news'] = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->join('user','news.user_id','=','user.id')
			->select('news.*','category.parent_id','category.title as cate_title','user.name as user_name')
			->where('user_id',$id)
			->paginate(10);
			$data['list_user'] = $user->getData('user',[]);
			$data['cate_news'] = $user->getData('category',['lang'=>Session::get('lang')]);
			return view('admin/news/search',$data);
		}else{
			return redirect('admin');
		}
	}
	public function searchByTitle(){
		$user = new AdminModel();
		if($_POST['search_name'] == ""){
			Session::flash('error','Mời nhập từ khóa tìm kiếm');
			return redirect()->back();
		}else{
			$str = $_POST['search_name'];
			$data['list_news'] = DB::table('news')
			->join('category','news.category_id','=','category.id')
			->join('user','news.user_id','=','user.id')
			->select('news.*','category.parent_id','category.title as cate_title','user.name as user_name')
			->where('news.title','like',str_replace(" ","%","%".$str."%"))
			->paginate(10);
			$data['list_user'] = $user->getData('user',[]);
			$data['cate_news'] = $user->getData('category',['lang'=>Session::get('lang')]);
			return view('admin/news/search',$data);
		}
	}
}
