<?php namespace App\Http\Controllers\admin\product;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,DB,Helper,Schema;
use Illuminate\Http\Request;

class ProductController extends Controller {

	public function index(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->product == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_pro'] = $user->getAllProduct(20);
				return view('admin.product.listproduct',$data);
			}
		}
	}
	public function getadd(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->add_product == 0){
				return redirect('admin');
			}else{

				$user = new AdminModel();
				return view('admin.product.addproduct');
			}
		}
	}
	public function postadd(){
		$user = new AdminModel();
		$site_option = $user->site_option();
		$name = $_POST['name'];
		$check_name = $user->countData('product',['name' => $name]);
		if($check_name > 0){
			Session::flash('error','Tên sản phẩm đã tồn tại!');
			return redirect()->back()->withInput();
		}else{
			$alias = $_POST['alias'];
			$check_alias = $user->countData('alias',['alias' => $alias]);
			if($check_alias > 0){
				Session::flash('error','Đường dẫn đã tồn tại!');
				return redirect()->back()->withInput();
			}else{
				if($_POST['code'] != ""){
					$code = $_POST['code'];
				}else{
					$code = "SP".str_random(8);
				}
				$size = $_POST['size'];
				if(!empty($_POST['price'])){
					$price = $_POST['price'];
				}else{
					$price = 0;
				}
				if(!empty($_POST['price_sale'])){
					$price_sale = $_POST['price_sale'];
				}else{
					$price_sale = 0;
				}
				$description = $_POST['description'];
				if($_POST['description_seo'] != ''){
					$description_seo = $_POST['description_seo'];
				}else{
					$description_seo = $name;
				}
				if($_POST['title_seo'] != ''){
					$title_seo = $_POST['title_seo'];
				}else{
					$title_seo = $name;
				}
				if($_POST['keyword_seo'] != ''){
					$keyword_seo = $_POST['keyword_seo'];
				}else{
					$keyword_seo = $name;
				}
				if(isset($_POST['active'])){
					$active = 1;
				}else{
					$active = 0;
				}
				if(isset($_POST['new'])){
					$new = 1;
				}else{
					$new = 0;
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
				$time = time();
				$content = $_POST['content'];
				$info = $_POST['info'];
				$guarantee = $_POST['guarantee'];
				$provider_id = $_POST['provider_id'];
				$category_id = end($_POST['category_id']);
				$country_id = $_POST['country_id'];
				$user_id = Session::get('user')->id;
				if($_FILES['image']['name'] == ""){
					$image = "";
					$thumb = "";
				}else{
					$get_ext = explode('.',$_FILES['image']['name']);
					$ext = '.'.end($get_ext);
					$image = 'public/upload/product/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/product/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						if(isset($_POST['watermark'])){
							Image::make($image)->fit(500, 371)->insert($site_option->watermark)->save($thumb);
						}else{
							Image::make($image)->fit(500, 371)->save($thumb);
						}
					}
				}

				$arr1 = [
					'name' => $name,
					'alias' => $alias,
					'code' => $code,
					'image' => $image,
					'thumb' => $thumb,
					'size' => $size,
					'price' => $price,
					'price_sale' => $price_sale,
					'description' => $description,
					'description_seo' => $description_seo,
					'title_seo' => $title_seo,
					'keyword_seo' => $keyword_seo,
					'user_id' => $user_id,
					'tags' => json_encode(@explode(',', $_POST['tags'])),
					'time' => $time,
					'active' => $active,
					'new' => $new,
					'home' => $home,
					'hot' => $hot,
					'focus' => $focus,
					'content' => $content,
					'info' => $info,
					'guarantee'=> $guarantee,
					'category_id' => $category_id,
					'provider_id' => $provider_id,
					'country_id' => $country_id,
					'view_count' => $view_count,
					'lang' => Session::get('lang')
				];
				$user->insertData('product',$arr1);
				$get_new = $user->getFirstRowWhere('product',['name' => $name]);
				$arr2 = [
					'alias' => $alias,
					'type' => 'product',
					'product' => $get_new->id,
				];
				$user->insertData('alias',$arr2);
				if($_POST['tags'] != ""){
					$tags = explode(',', $_POST['tags']);
					foreach ($tags as $value) {
						$tags_alias = Helper::make_alias(trim($value));
						$check_alias_tags = $user->countData('tags',['alias' => $tags_alias,'id_product' => $get_new->id]);
						if($check_alias_tags == 0){
							$arr = [
								'name' => $value,
								'alias' => $tags_alias,
								'id_product' => $get_new->id,
								'lang' => Session::get('lang'),
							];
							$user->insertData('tags',$arr);
						}
					}
				}
				for($i=0;$i<count($_POST['category_id']);$i++){
					$user->insertData('product_to_category',[
						'id_product' => $get_new->id,
						'id_category' => $_POST['category_id'][$i],
					]);
				}
				Session::flash('success','Thêm sản phẩm thành công!');
				return redirect('admin/list-product');
			}
		}
	}
	public function del($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->edit_product == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$get_old = $user->getFirstRowWhere('product',['id' => $id]);
				if(file_exists($get_old->image)){
					unlink($get_old->image);
				}
				if(file_exists($get_old->thumb)){
					unlink($get_old->thumb);
				}
				$user->deleteData('product',['id'=>$id]);
				$user->deleteData('alias',['alias' => $get_old->alias]);
				$user->deleteData('product_to_category',['id_product' => $get_old->id]);
				$get_image = $user->getData('image',['id_product' => $id]);
				if(!empty($get_image)){
					foreach ($get_image as $key => $value) {
						if(file_exists($value->link)){
							unlink($value->link);
						}
						if(file_exists($value->thumb)){
							unlink($value->thumb);
						}
					}
				}
				$user->deleteData('image',['id_product' => $id]);
				$user->deleteData('tags',['id_product' => $id]);
				Session::flash('success','Xóa sản phẩm thành công');
				return redirect('admin/list-product');
			}
		}
	}
	public function getedit($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->edit_product == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['get_old'] = $user->getFirstRowWhere('product',['id' => $id]);
				return view('admin.product.editproduct',$data);
			}
		}
	}
	public function postedit($id){
		$user = new AdminModel();
		$site_option = $user->site_option();
		$get_old = $user->getFirstRowWhere('product',['id' => $id]);
		$get_old_alias = $user->getFirstRowWhere('alias',['product' => $id]);
		$name = $_POST['name'];
		$check_name = DB::table('product')->where('name',$name)->where('id','!=',$id)->count();
		if($check_name > 0){
			Session::flash('error','Tên sản phẩm đã tồn tại!');
			return redirect()->back()->withInput();
		}else{
			$alias = $_POST['alias'];
			$check_alias = DB::table('alias')->where('alias',$alias)->where('id','!=',$get_old_alias->id)->count();
			if($check_alias > 0){
				Session::flash('error','Đường dẫn đã tồn tại!');
				return redirect()->back()->withInput();
			}else{
				if($_POST['code'] == ""){
					$code = Helper::random_code(10);
				}else{
					$code = $_POST['code'];
				}
				$size = $_POST['size'];
				if(!empty($_POST['price'])){
					$price = $_POST['price'];
				}else{
					$price = 0;
				}
				if(!empty($_POST['price_sale'])){
					$price_sale = $_POST['price_sale'];
				}else{
					$price_sale = 0;
				}
				$description = $_POST['description'];
				if($_POST['description_seo'] != ''){
					$description_seo = $_POST['description_seo'];
				}else{
					$description_seo = $name;
				}
				if($_POST['title_seo'] != ''){
					$title_seo = $_POST['title_seo'];
				}else{
					$title_seo = $name;
				}
				if($_POST['keyword_seo'] != ''){
					$keyword_seo = $_POST['keyword_seo'];
				}else{
					$keyword_seo = $name;
				}
				if(isset($_POST['active'])){
					$active = 1;
				}else{
					$active = 0;
				}
				if(isset($_POST['new'])){
					$new = 1;
				}else{
					$new = 0;
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
				$time = time();
				$content = $_POST['content'];
				$info = $_POST['info'];
				$provider_id = $_POST['provider_id'];
				$category_id = end($_POST['category_id']);
				$country_id = $_POST['country_id'];
				$user_id = Session::get('user')->id;
				if($_FILES['image']['name'] == ""){
					$image = $get_old->image;
					if(isset($_POST['watermark'])){
						Image::make($get_old->thumb)->insert($site_option->watermark)->save($get_old->thumb);
						$thumb = $get_old->thumb;
					}else{
						$thumb = $get_old->thumb;
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
					$image = 'public/upload/product/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/product/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						if(isset($_POST['watermark'])){
							Image::make($image)->fit(500, 371)->insert($site_option->watermark)->save($thumb);
						}else{
							Image::make($image)->fit(500, 371)->save($thumb);
						}
					}
				}
				$arr1 = [
					'name' => $name,
					'alias' => $alias,
					'code' => $code,
					'image' => $image,
					'thumb' => $thumb,
					'size' => $size,
					'price' => $price,
					'price_sale' => $price_sale,
					'description' => $description,
					'description_seo' => $description_seo,
					'title_seo' => $title_seo,
					'keyword_seo' => $keyword_seo,
					'user_id' => $user_id,
					'time' => $time,
					'active' => $active,
					'new' => $new,
					'home' => $home,
					'hot' => $hot,
					'focus' => $focus,
					'content' => $content,
					'info' => $info,
					'category_id' => $category_id,
					'provider_id' => $provider_id,
					'country_id' => $country_id,
					'view_count' => $view_count,
					'tags' => json_encode(explode(',',$_POST['tags']))
				];
				$user->updateData('product',['id' => $id],$arr1);
				$user->updateData('alias',['id' => $get_old_alias->id],['alias'=>$alias]);
				$user->deleteData('tags',['id_product' => $id]);
				$user->deleteData('product_to_category',['id_product' => $get_old->id]);
				if($_POST['tags'] != ""){
					$tags = explode(',', $_POST['tags']);
					foreach ($tags as $value) {
						$tags_alias = Helper::make_alias(trim($value));
						$check_alias_tags = $user->countData('tags',['alias' => $tags_alias,'id_product' => $id]);
						if($check_alias_tags == 0){
							$arr = [
								'name' => $value,
								'alias' => $tags_alias,
								'id_product' => $id,
								'lang' => Session::get('lang'),
							];
							$user->insertData('tags',$arr);
						}
					}
				}
				for($i=0;$i<count($_POST['category_id']);$i++){
					$user->insertData('product_to_category',[
						'id_product' => $get_old->id,
						'id_category' => $_POST['category_id'][$i],
					]);
				}
				Session::flash('success','Sửa thông tin sản phẩm thành công');
				return redirect('admin/list-product');
			}
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$product = $_POST['check_del'];
				$count = count($product);
				for($i=0;$i<$count;$i++){
					$id = $product[$i];
					$get_old = $user->getFirstRowWhere('product',['id'=>$id]);
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					$user->deleteData('product',['id'=>$id]);
					$user->deleteData('tags',['id_product' => $id]);
					$user->deleteData('product_to_category',['id_product' => $get_old->id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
				}
				return redirect('admin/list-product');
			}else{
				return redirect('admin/list-product');
			}
		}
	}
	public function getSearch(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$search_name = $_GET['search_name'];
			$data['list_pro'] = $user->getProductLike($search_name,20);
			return view('admin.product.listproduct',$data);
		}
	}
	public function getListOrder(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->order == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_order'] = $user->getData('order',[],'id','desc');
				return view('admin.product.listorder',$data);
			}
		}
	}
	public function delOrder($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->order == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$user->deleteData('order',['id' => $id]);
				Session::flash('error','Xóa đơn hàng thành công');
				return redirect(url('admin/list-order'));
			}
		}
	}
	public function delMultiOrder(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$order = $_POST['check_del'];
				$count = count($order);
				for($i=0;$i<$count;$i++){
					$id = $order[$i];
					$user->deleteData('order',['id'=>$id]);
				}
				return redirect('admin/list-order');
			}else{
				return redirect('admin/list-order');
			}
		}
	}
	public function searchByCate($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->product == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_pro'] = $user->getSearchProductByCate($id,20);
				return view('admin.product.listsearch',$data);
					
			}
		}
	}
	public function searchByProvider($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->product == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_pro'] = $user->getSearchProductByProvider($id,20);
				return view('admin.product.listsearch',$data);
					
			}
		}
	}
	public function searchByCountry($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->product == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['list_pro'] = $user->getSearchProductByCountry($id,20);
				return view('admin.product.listsearch',$data);
					
			}
		}
	}

}
