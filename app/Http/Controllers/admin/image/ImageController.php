<?php namespace App\Http\Controllers\admin\image;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use App\model\SimpleImage;
use Session,DB,Image,Helper,Schema;
use Illuminate\Http\Request;

class ImageController extends Controller {

	public function index(){
		$user = new Adminmodel();
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->gallery == 0){
				return redirect('admin');
			}else{
				$data['list_img'] = $user->getdata('image',['id_product' => 0, 'lang' => Session::get('lang')]);
				return view('admin.image.listimage',$data);
			}
		}
	}
	public function productImage(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->gallery == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_img'] = $user->getListProductImage();
				return view('admin.image.listproductimage',$data);
			}
		}
	}
	public function getAddImage(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->gallery == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				return view('admin.image.add');
			}
		}
	}
	public function getAddProductImage($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->gallery == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['product'] = $user->getFirstRowWhere('product',['id' => $id]);
				return view('admin.image.add',$data);
			}
		}
	}
	public function postAddImage(){
		$user = new AdminModel();
		if(isset($_POST['submit'])){
			$position = $_POST['position'];
			if(isset($_POST['id_product'])){
				$id_product = $_POST['id_product'];
			}else{
				$id_product = 0;
			}
			$description = $_POST['description'];
			$count = count($_FILES['image']['name']);
			if($count == 0){
				Session::flash('error','Mời bạn chọn ảnh');
				return redirect()->back();
			}else{
				for ($i=0; $i < $count ; $i++) { 
					$title = $_POST['title'];
					$get_ext = explode('.',$_FILES['image']['name'][$i]);
					$ext = '('.$i.').'.end($get_ext);
					$link = 'public/upload/image/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'][$i];
					if(!file_exists($link)){
						Image::make($tmp_name)->save($link);
					}

					$thumb = 'public/upload/image/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						Image::make($link)->fit(300, 180)->save($thumb);
					}
					if($title == "" || $i == 0){
						$title = $title;
					}else{
						$title = $title.'('.$i.')';
					}
					$arr = [
						'title' => $title,
						'position' => $position,
						'id_product' => $id_product,
						'description' => $description,
						'time' => time(),
						'link' => $link,
						'thumb' => $thumb,
						'lang' => Session::get('lang'),
					];
					$user->insertData('image',$arr);
				}
			}
			return redirect('admin/list-image');
		}
	}
	public function postAddProductImage($id){
		$user = new AdminModel();
		if(isset($_POST['submit'])){
			$title = $_POST['title'];
			$position = $_POST['position'];
			$description = $_POST['description'];
			if(isset($_POST['id_product'])){
				$id_product = $_POST['id_product'];
			}else{
				$id_product = 0;
			}
			if($_FILES['image']['name'] == ""){
				Session::flash('error','Mời bạn chọn ảnh');
				return redirect()->back();
			}else{
				$count = count($_FILES['image']['name']);
				for($i = 0; $i < $count; $i++){
					$get_ext = explode('.',$_FILES['image']['name'][$i]);
					$ext = '('.$i.').'.end($get_ext);
					$link = 'public/upload/image/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'][$i];
					if(!file_exists($link)){
						Image::make($tmp_name)->save($link);
					}

					$thumb = 'public/upload/image/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						Image::make($link)->fit(310, 310)->save($thumb);
					}
					$arr = [
						'title' => $title,
						'position' => $position,
						'id_product' => $id_product,
						'time' => time(),
						'link' => $link,
						'thumb' => $thumb,
						'description' => $description,
						'lang' => Session::get('lang'),
					];
					$user->insertData('image',$arr);
				}
				Session::flash('success','Thêm ảnh thành công');
				return redirect('admin/list-product');
			}
		}
	}
	public function delImage($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->gallery == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$get_old = $user->getFirstRowWhere('image',['id'=> $id]);
				if(file_exists($get_old->link)){
					unlink($get_old->link);
				}
				if (file_exists($get_old->thumb)) {
					unlink($get_old->thumb);
				}
				$user->deleteData('image',['id' => $id]);
				return redirect('admin/list-image');
			}
		}
	}
	public function getEditImage($id){
		$user = new AdminModel();
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->gallery == 0){
				return redirect('admin');
			}else{
				$data['get_old'] = $user->getFirstRowWhere('image',['id' => $id]);
				$get_old = $data['get_old'];
				if($get_old->id_product > 0){
					$data['product'] = $user->getFirstRowWhere('product',['id' => $get_old->id_product]);
				}
				return view('admin.image.edit',$data);
			}
		}
	}
	public function postEditImage($id){
		$user = new AdminModel();
		$get_old = $user->getFirstRowWhere('image',['id' => $id]);
		$title = $_POST['title'];
		$position = $_POST['position'];
		$description = $_POST['description'];
		if($position != 'product'){
			$id_product = 0;
		}else{
			$id_product = $get_old->id_product;
		}
		$url = $_POST['url'];
		$description = $_POST['description'];
		if($_FILES['image']['name'] == ""){
			$link = $get_old->link;
			$thumb = $get_old->thumb;
		}else{
			if(file_exists($get_old->link)){
				unlink($get_old->link);
			}
			if (file_exists($get_old->thumb)) {
				unlink($get_old->thumb);
			}
			$get_ext = explode('.',$_FILES['image']['name']);
			$ext = '.'.end($get_ext);
			$link = 'public/upload/image/'.time().$ext;
			if(!file_exists($link)){
				$tmp_name = $_FILES['image']['tmp_name'];
				Image::make($tmp_name)->save($link);
			}
			$thumb = 'public/upload/image/thumb/'.time().$ext;
			if(!file_exists($thumb)){
				Image::make($link)->fit(300, 180)->save($thumb);
			}
		}
		$arr = [
			'position' => $position,
			'title' => $title,
			'url' => $url,
			'description' => $description,
			'link' => $link,
			'thumb' => $thumb,
			'time' => time(),
			'description' => $description,
			'id_product' => $id_product,
		];
		$user->updateData('image',['id' => $id],$arr);
		Session::flash('success','Sửa thành công');
		if($get_old->position == 'product'){
			return redirect('admin/list-product-image');
		}else{
			return redirect('admin/list-image');
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$image = $_POST['check_del'];
				$count = count($image);
				for($i=0;$i<$count;$i++){
					$id = $image[$i];
					$get_old = $user->getFirstRowWhere('image',['id'=>$id]);
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					if(file_exists($get_old->link)){
						unlink($get_old->link);
					}
					$user->deleteData('image',['id'=>$id]);
				}
				return redirect('admin/list-image');
			}else{
				return redirect('admin/list-image');
			}
		}
	}

}
