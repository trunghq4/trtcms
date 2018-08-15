<?php namespace App\Http\Controllers\admin\product;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,Db,Helper,Schema;
use Illuminate\Http\Request;

class CategoryProductController extends Controller {
	public function index(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->product_cate == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_cate'] = $user->getData('product_category',['lang' => Session::get('lang')]);
				return view('admin/product/listcate',$data);
			}
		}
	}
	public function getadd(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->add_product_cate == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_cate'] = $user->getData('product_category',['lang' => Session::get('lang')],'id','desc');
				return view('admin/product/addcate',$data);
			}
		}
	}
	public function postadd(){
		$user = new AdminModel();
		$name = $_POST['name'];
		$check_name = $user->countData('product_category',['name'=>$name]);
		if($check_name > 0){
			Session::flash('error','Tên danh mục đã tồn tại');
			return redirect()->back()->withInput();
		}else{
			$alias = $_POST['alias'];
			$check_alias = $user->countData('alias',['alias'=>$alias]);
			if($check_alias > 0){
				Session::flash('error','Tên đường dẫn đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				if($_POST['title_seo'] == ""){
					$title_seo = $name;
				}else{
					$title_seo = $_POST['title_seo'];
				}
				if($_POST['description_seo'] == ""){
					$description_seo = $name;
				}else{
					$description_seo = $_POST['description_seo'];
				}
				if($_POST['keyword_seo'] == ""){
					$keyword_seo = $name;
				}else{
					$keyword_seo = $_POST['keyword_seo'];
				}
				$description = $_POST['description'];
				$parent_id = $_POST['parent_id'];
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
				if($_FILES['image']['name'] == ''){
					$image = '';
					$thumb = '';
				}else{
					$get_ext = explode('.',$_FILES['image']['name']);
					$ext = '.'.end($get_ext);
					$image = 'public/upload/catepro/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/catepro/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						Image::make($image)->fit(300, 180)->save($thumb);
					}
				}
				$arr1 = [
					'name' => $name,
					'description' => $description,
					'alias' => $alias,
					'title_seo' => $title_seo,
					'description_seo' => $description_seo,
					'keyword_seo' => $keyword_seo,
					'time' => time(),
					'parent_id' => $parent_id,
					'hot' => $hot,
					'home' => $home,
					'focus' => $focus,
					'image' => $image,
					'thumb' => $thumb,
					'lang' => Session::get('lang')
				];
				$user->insertData('product_category',$arr1);
				$get_new = $user->getFirstRowWhere('product_category',['name' => $name]);
				$arr2 = [
					'alias' => $alias,
					'type' => 'catepro',
					'product_cate' => $get_new->id,
				];
				$user->insertData('alias',$arr2);
				Session::flash('success','Thêm danh mục thành công');
				return redirect('admin/list-cate-product');
			}
		}
	}
	public function del($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->edit_product_cate == 0 || $id == 1){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$get_old = $user->getFirstRowWhere('product_category',['id' => $id]);
				if(file_exists($get_old->image)){
					unlink($get_old->image);
				}
				if(file_exists($get_old->thumb)){
					unlink($get_old->thumb);
				}
				$user->deleteData('product_category',['id' => $id]);
				$user->deleteData('alias',['alias' => $get_old->alias]);
				$get_product = $user->getData('product_to_category',['id_category' => $get_old->id]);
				$user->deleteData('product_to_category',['id_category'=>$get_old->id]);
				foreach ($get_product as $key => $value) {
					$check = $user->countData('product_to_category',['id_product' => $value->id_product]);
					if($check == 0){
						$user->insertData('product_to_category',[
							'id_product' => $value->id_product,
							'id_category' => 1
						]);
						$user->updateData('product',['category_id'=>$id],['category_id'=>1]);
					}else{
						$update_product = $user->getFirstRowWhere('product_to_category',['id_product' => $value->id_product]);
						$user->updateData('product',['category_id'=>$id],['category_id'=>$update_product->id_category]);
					}
				}
				Session::flash('success','Xóa danh mục thành công!');
				return redirect('admin/list-cate-product');
			}
		}
	}
	public function getedit($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->edit_product_cate == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['get_old'] = $user->getFirstRowWhere('product_category',['id' => $id]);
				$data['list_cate'] = $user->getData('product_category',['lang' => Session::get('lang')]);
				return view('admin/product/editcate',$data);
			}
		}
	}
	public function postedit($id){
		$user = new AdminModel();
		$get_old = $user->getFirstRowWhere('product_category',['id' => $id]);
		$name = $_POST['name'];
		$check_name = DB::table('product_category')->where('name',$name)->where('id','!=',$id)->count();
		if($check_name > 0){
			Session::flash('error','Tên danh mục đã tồn tại');
			return redirect()->back()->withInput();
		}else{
			$get_old_alias = $user->getFirstRowWhere('alias',['alias' => $get_old->alias]);
			$alias = $_POST['alias'];
			$check_alias = DB::table('alias')->where('alias',$alias)->where('id','!=',$get_old_alias->id)->count();
			if($check_alias > 0){
				Session::flash('error','Đường dẫn đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				if($_POST['title_seo'] == ''){
					$title_seo = $name;
				}else{
					$title_seo = $_POST['title_seo'];
				}
				if($_POST['description_seo'] == ''){
					$description_seo = $name;
				}else{
					$description_seo = $_POST['description_seo'];
				}
				if($_POST['keyword_seo'] == ''){
					$keyword_seo = $name;
				}else{
					$keyword_seo = $_POST['keyword_seo'];
				}
				$parent_id = $_POST['parent_id'];
				$description = $_POST['description'];
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
				if($_FILES['image']['name'] == ''){
					$image = $get_old->image;
					$thumb = $get_old->thumb;
				}else{
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					if (file_exists($get_old->thumb)) {
						unlink($get_old->thumb);
					}
					$get_ext = explode('.',$_FILES['image']['name']);
					$ext = '.'.end($get_ext);
					$image = 'public/upload/catepro/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/catepro/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						Image::make($image)->fit(300, 180)->save($thumb);
					}
				}
				$arr1 = [
					'name' => $name,
					'alias' => $alias,
					'title_seo' => $title_seo,
					'description_seo' => $description_seo,
					'keyword_seo' => $keyword_seo,
					'time' => time(),
					'description' => $description,
					'parent_id' => $parent_id,
					'hot' => $hot,
					'home' => $home,
					'focus' => $focus,
					'image' => $image,
					'thumb' => $thumb,
				];
				$user->updateData('product_category',['id' => $id],$arr1);
				$user->updateData('alias',['id' => $get_old_alias->id],['alias' => $alias]);
				Session::flash('success','Sửa danh mục thành công');
				return redirect('admin/list-cate-product');
			}
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$product_category = $_POST['check_del'];
				$count = count($product_category);
				for($i=0;$i<$count;$i++){
					$id = $product_category[$i];
					$get_old = $user->getFirstRowWhere('product_category',['id'=>$id]);
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					$user->deleteData('product_category',['id'=>$id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
					$get_product = DB::table('product_to_category')->where('id_category',$get_old->id)->get();
					$user->deleteData('product_to_category',['id_category' => $get_old->id]);
					foreach($get_product as $items){
						$check = DB::table('product_to_category')->where('id_product',$items->id_product)->count();
						if($check == 0){
							$user->insertData('product_to_category',[
								'id_product' => $items->id_product,
								'id_category' => 1,
							]);
							$user->updateData('product',['category_id'=>$id],['category_id'=>1]);
						}else{
							$update_product = $user->getFirstRowWhere('product_to_category',['id_product' => $items->id_product]);
							$user->updateData('product',['category_id'=>$id],['category_id'=>$update_product->id_category]);
						}
					}
				}
				return redirect('admin/list-cate-product');
			}else{
				return redirect('admin/list-cate-product');
			}
		}
	}
}
