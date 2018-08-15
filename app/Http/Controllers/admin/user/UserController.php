<?php namespace App\Http\Controllers\admin\user;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session,Image,DB,Schema;
use App\model\AdminModel;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function index(){
		if(Schema::hasTable('user')){
			if (Session::has('user') && Session::get('user')->user == 1) {
				$user = new AdminModel();
				$data['all_user'] = $user->getAll('user');
				return view('admin.user.listuser',$data);
			}else{
				Session::flash('error','Bạn không đủ quyền xem nội dung này!');
				return redirect()->back();
			}
		}else{
			return redirect('admin');
		}
	}
	public function getadd(){
		if (Session::has('user') && Schema::hasTable('user')) {
			$user = new AdminModel();
			return view('admin.user.adduser');
		}else{
			return redirect('admin');
		}
	}
	public function postadd(){
		if(isset($_POST['submit'])){
			$data = new AdminModel();
			$name = $_POST['name'];
			$account = $_POST['account'];
			$email = $_POST['email'];
			$check = DB::table('user')->where('account',$account)->orwhere('email',$email)->count();
			if($check >0){
				Session::flash('error','Tài khoản hoặc email đã tồn tại');
				return redirect()->back();
			}else{
				$level = $_POST['level'];
				$phone = $_POST['phone'];
				$address = $_POST['address'];
				if($_FILES['image']['name'] == ""){
					$image = "";
					$thumb = "";
				}else{
					$get_ext = explode('.',$_FILES['image']['name']);
					$ext = '.'.end($get_ext);
					$image = 'public/upload/user/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/user/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						Image::make($image)->fit(150, 90)->save($thumb);
					}
				}
				$password = sha1(md5($_POST['password']));
				$re_password = sha1(md5($_POST['re_password']));
				if($password != $re_password){
					Session::flash('error','Mật khẩu không khớp');
					return redirect()->back();
				}else{
					if(Session::get('user')->level == 1){
						if(isset($_POST['user'])){
							$user = 1;
						}else{
							$user = 0;
						}
						if(isset($_POST['news'])){
							$news = 1;
						}else{
							$news = 0;
						}
						if(isset($_POST['news_cate'])){
							$news_cate = 1;
						}else{
							$news_cate = 0;
						}
						if(isset($_POST['add_news'])){
							$add_news = 1;
						}else{
							$add_news = 0;
						}
						if(isset($_POST['add_news_cate'])){
							$add_news_cate = 1;
						}else{
							$add_news_cate = 0;
						}
						if(isset($_POST['edit_news'])){
							$edit_news = 1;
						}else{
							$edit_news = 0;
						}
						if(isset($_POST['edit_news_cate'])){
							$edit_news_cate = 1;
						}else{
							$edit_news_cate = 0;
						}
						if(isset($_POST['product'])){
							$product = 1;
						}else{
							$product = 0;
						}
						if(isset($_POST['product_cate'])){
							$product_cate = 1;
						}else{
							$product_cate = 0;
						}
						if(isset($_POST['add_product'])){
							$add_product = 1;
						}else{
							$add_product = 0;
						}
						if(isset($_POST['add_product_cate'])){
							$add_product_cate = 1;
						}else{
							$add_product_cate = 0;
						}
						if(isset($_POST['edit_product'])){
							$edit_product = 1;
						}else{
							$edit_product = 0;
						}
						if(isset($_POST['edit_product_cate'])){
							$edit_product_cate = 1;
						}else{
							$edit_product_cate = 0;
						}
						if(isset($_POST['page'])){
							$page = 1;
						}else{
							$page = 0;
						}
						if(isset($_POST['menu'])){
							$menu = 1;
						}else{
							$menu = 0;
						}
						if(isset($_POST['order'])){
							$order = 1;
						}else{
							$order = 0;
						}
						if(isset($_POST['site_option'])){
							$site_option = 1;
						}else{
							$site_option = 0;
						}
						if(isset($_POST['gallery'])){
							$gallery = 1;
						}else{
							$gallery = 0;
						}
						if(isset($_POST['module'])){
							$module = 1;
						}else{
							$module = 0;
						}
					}else{
						if($_POST['level'] == 2){
							$user = 1;
							$news = 1;
							$news_cate = 1;
							$add_news = 1;
							$add_news_cate = 1;
							$edit_news = 1;
							$edit_news_cate = 1;
							$product = 1;
							$product_cate = 1;
							$add_product = 1;
							$add_product_cate = 1;
							$edit_product = 1;
							$edit_product_cate = 1;
							$page = 1;
							$menu = 0;
							$order = 1;
							$gallery = 0;
							$site_option = 0;
							$moudle = 0;
						}elseif($_POST['level'] == 3){
							$user = 0;
							$news = 1;
							$news_cate = 1;
							$add_news = 1;
							$add_news_cate = 1;
							$edit_news = 1;
							$edit_news_cate = 1;
							$product = 1;
							$product_cate = 1;
							$add_product = 1;
							$add_product_cate = 1;
							$edit_product = 1;
							$edit_product_cate = 1;
							$page = 1;
							$menu = 0;
							$order = 0;
							$gallery = 0;
							$site_option = 0;
							$moudle = 0;
						}elseif($_POST['level'] == 4){
							$user = 0;
							$news = 1;
							$news_cate = 1;
							$add_news = 1;
							$add_news_cate = 1;
							$edit_news = 0;
							$edit_news_cate = 0;
							$product = 1;
							$product_cate = 1;
							$add_product = 1;
							$add_product_cate = 1;
							$edit_product = 0;
							$edit_product_cate = 0;
							$page = 1;
							$menu = 0;
							$order = 0;
							$gallery = 0;
							$site_option = 0;
							$moudle = 0;
						}else{
							$user = 0;
							$news = 0;
							$news_cate = 0;
							$add_news = 0;
							$add_news_cate = 0;
							$edit_news = 0;
							$edit_news_cate = 0;
							$product = 0;
							$product_cate = 0;
							$add_product = 0;
							$add_product_cate = 0;
							$edit_product = 0;
							$edit_product_cate = 0;
							$menu = 0;
							$order = 0;
							$gallery = 0;
							$site_option = 0;
							$moudle = 0;
						}
					}
				$arr = [
					'name' => $name,
					'account' => $account,
					'email' => $email,
					'level' => $level,
					'phone' => $phone,
					'address' => $address,
					'image' => $image,
					'thumb' => $thumb,
					'password' => $password,
					'user' => $user,
					'news' => $news,
					'news_cate' => $news_cate,
					'add_news' => $add_news,
					'add_news_cate' => $add_news_cate,
					'edit_news' => $edit_news,
					'edit_news_cate' => $edit_news_cate,
					'product' => $product,
					'product_cate' => $product_cate,
					'add_product' => $add_product,
					'add_product_cate' => $add_product_cate,
					'edit_product' => $edit_product,
					'edit_product_cate' => $edit_product_cate,
					'gallery' => $gallery,
					'order' => $order,
					'site_option' => $site_option,
					'menu' => $menu,
					'page' => $page,
					'module' => $module,
				];
				$data->insertData('user',$arr);
				Session::flash('success','Thêm thành viên thành công');
				return redirect('admin/list-user');
				}
			}
		}
	}
	public function del($id){
		if(!Session::has('user') OR Session::get('user')->user == 0 ||  !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$data = new AdminModel();
			$get_old = $data->getFirstRowWhere('user',['id'=>$id]);
			if(Session::get('user')->level == 1){
				if($id ==1 ){
					Session::flash('error','Không thể xóa Thành viên này');
					return redirect('admin/list-user');
				}else{
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					$data->updateData('news',['user_id'=>$id],['user_id'=>1]);
					$data->updateData('product',['user_id'=>$id],['user_id'=>1]);
					$data->deleteData('user',['id' => $id]);
					Session::flash('success','Xóa Thành viên thành công');
					return redirect('admin/list-user');
				}
			}else{
				if($get_old->level == 1){
					Session::flash('error','Không thể xóa thành viên này');
					return redirect('admin/list-user');
				}else{
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					$data->updateData('news',['user_id'=>$id],['user_id'=>1]);
					$data->updateData('product',['user_id'=>$id],['user_id'=>1]);
					$data->deleteData('user',['id' => $id]);
					Session::flash('success','Xóa Thành viên thành công');
					return redirect('admin/list-user');
				}
			}
		}
	}
	public function getedit($id){
		if(Schema::hasTable('user')){
			if(Session::get('user')->user == 1){
				$users = new AdminModel();
				if($id == 1){
					Session::flash('error','Không thể sửa thành viên này!');
					return redirect()->back();
				}else{
					$data['get_user'] = $users->getFirstRowWhere('user',['id' => $id]);
					return view('admin.user.edituser',$data);
				}
			}else{
				Session::flash('error','Bạn không đủ quyền thực hiện hành động này');
				return redirect()->back();
			}
		}else{
			return redirect('admin');
		}
			
	}
	public function postedit($id){
		if(isset($_POST['submit'])){
			$data = new AdminModel();
			$get_old = $data->getFirstRowWhere('user',['id'=>$id]);
			$name = $_POST['name'];
			$account = $_POST['account'];
			$email = $_POST['email'];
			$check = DB::table('user')->where('account',$account)->where('id','!=',$id)->orwhere('email',$email)->where('id','!=',$id)->count();
			if($check >0){
				Session::flash('error','Tài khoản hoặc email đã tồn tại');
				return redirect()->back();
			}else{
				$level = $_POST['level'];
				$phone = $_POST['phone'];
				$address = $_POST['address'];
				if($_FILES['image']['name'] == ""){
					$image = $get_old->image;
					$thumb = $get_old->thumb;
				}else{
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					$get_ext = explode('.',$_FILES['image']['name']);
					$ext = '.'.end($get_ext);
					$image = 'public/upload/user/'.time().$ext;
					$tmp_name = $_FILES['image']['tmp_name'];
					if(!file_exists($image)){
						Image::make($tmp_name)->save($image);
					}
					$thumb = 'public/upload/user/thumb/'.time().$ext;
					if(!file_exists($thumb)){
						Image::make($image)->fit(150, 90)->save($thumb);
					}
				}
				$password = $get_old->password;
				$re_password = $password;
				if($password != $re_password){
					Session::flash('error','Mật khẩu không khớp');
					return redirect()->back();
				}else{
					if(Session::get('user')->level == 1){
						if(isset($_POST['user'])){
							$user = 1;
						}else{
							$user = 0;
						}
						if(isset($_POST['news'])){
							$news = 1;
						}else{
							$news = 0;
						}
						if(isset($_POST['news_cate'])){
							$news_cate = 1;
						}else{
							$news_cate = 0;
						}
						if(isset($_POST['add_news'])){
							$add_news = 1;
						}else{
							$add_news = 0;
						}
						if(isset($_POST['add_news_cate'])){
							$add_news_cate = 1;
						}else{
							$add_news_cate = 0;
						}
						if(isset($_POST['edit_news'])){
							$edit_news = 1;
						}else{
							$edit_news = 0;
						}
						if(isset($_POST['edit_news_cate'])){
							$edit_news_cate = 1;
						}else{
							$edit_news_cate = 0;
						}
						if(isset($_POST['product'])){
							$product = 1;
						}else{
							$product = 0;
						}
						if(isset($_POST['product_cate'])){
							$product_cate = 1;
						}else{
							$product_cate = 0;
						}
						if(isset($_POST['add_product'])){
							$add_product = 1;
						}else{
							$add_product = 0;
						}
						if(isset($_POST['add_product_cate'])){
							$add_product_cate = 1;
						}else{
							$add_product_cate = 0;
						}
						if(isset($_POST['edit_product'])){
							$edit_product = 1;
						}else{
							$edit_product = 0;
						}
						if(isset($_POST['edit_product_cate'])){
							$edit_product_cate = 1;
						}else{
							$edit_product_cate = 0;
						}
						if(isset($_POST['menu'])){
							$menu = 1;
						}else{
							$menu = 0;
						}
						if(isset($_POST['order'])){
							$order = 1;
						}else{
							$order = 0;
						}
						if(isset($_POST['site_option'])){
							$site_option = 1;
						}else{
							$site_option = 0;
						}
						if(isset($_POST['gallery'])){
							$gallery = 1;
						}else{
							$gallery = 0;
						}
						if(isset($_POST['page'])){
							$page = 1;
						}else{
							$page = 0;
						}
						if(isset($_POST['module'])){
							$module = 1;
						}else{
							$module = 0;
						}
					}else{
						if($_POST['level'] == 2){
							$user = 1;
							$news = 1;
							$news_cate = 1;
							$add_news = 1;
							$add_news_cate = 1;
							$edit_news = 1;
							$edit_news_cate = 1;
							$product = 1;
							$product_cate = 1;
							$add_product = 1;
							$add_product_cate = 1;
							$edit_product = 1;
							$edit_product_cate = 1;
							$menu = 0;
							$order = 1;
							$gallery = 0;
							$site_option = 0;
							$page = 1;
							$module = 0;
						}elseif($_POST['level'] == 3){
							$user = 0;
							$news = 1;
							$news_cate = 1;
							$add_news = 1;
							$add_news_cate = 1;
							$edit_news = 1;
							$edit_news_cate = 1;
							$product = 1;
							$product_cate = 1;
							$add_product = 1;
							$add_product_cate = 1;
							$edit_product = 1;
							$edit_product_cate = 1;
							$menu = 0;
							$order = 0;
							$gallery = 0;
							$site_option = 0;
							$page = 1;
							$module = 0;
						}elseif($_POST['level'] == 4){
							$user = 0;
							$news = 1;
							$news_cate = 1;
							$add_news = 1;
							$add_news_cate = 1;
							$edit_news = 0;
							$edit_news_cate = 0;
							$product = 1;
							$product_cate = 1;
							$add_product = 1;
							$add_product_cate = 1;
							$edit_product = 0;
							$edit_product_cate = 0;
							$menu = 0;
							$order = 0;
							$gallery = 0;
							$site_option = 0;
							$page = 0;
							$module = 0;
						}else{
							$user = 0;
							$news = 0;
							$news_cate = 0;
							$add_news = 0;
							$add_news_cate = 0;
							$edit_news = 0;
							$edit_news_cate = 0;
							$product = 0;
							$product_cate = 0;
							$add_product = 0;
							$add_product_cate = 0;
							$edit_product = 0;
							$edit_product_cate = 0;
							$menu = 0;
							$order = 0;
							$gallery = 0;
							$site_option = 0;
							$page = 0;
							$module = 0;
						}
					}
				$arr = [
					'name' => $name,
					'account' => $account,
					'email' => $email,
					'level' => $level,
					'phone' => $phone,
					'address' => $address,
					'image' => $image,
					'thumb' => $thumb,
					'password' =>  $password,
					'user' => $user,
					'news' => $news,
					'news_cate' => $news_cate,
					'add_news' => $add_news,
					'add_news_cate' => $add_news_cate,
					'edit_news' => $edit_news,
					'edit_news_cate' => $edit_news_cate,
					'product' => $product,
					'product_cate' => $product_cate,
					'add_product' => $add_product,
					'add_product_cate' => $add_product_cate,
					'edit_product' => $edit_product,
					'edit_product_cate' => $edit_product_cate,
					'gallery' => $gallery,
					'order' => $order,
					'site_option' => $site_option,
					'menu' => $menu,
					'page' => $page,
					'module' => $module,
				];
				$data->updateData('user',['id' => $id],$arr);
				$data_user = $data->getFirstRowWhere('user',['id' => Session::get('user')->id]);
				Session::flash('success','Sửa thông tin thành công');
				return redirect('admin/list-user');
				}
			}
		}
	}
	public function getChangePass(){
		if(Session::has('user') && Schema::hasTable('user')){
			return view('admin.user.passwordChange');
		}else{
			return redirect('admin');
		}
	}

	public function postChangePass(){
		if(isset($_POST['submit'])){
			$oldpassword = $_POST['oldpassword'];
			$oldpassword = sha1(md5($oldpassword));
			$password = $_POST['password'];
			$re_password = $_POST['re_password'];
			if($oldpassword != Session::get('user')->password){
				Session::flash('error','Mật khẩu không đúng!');
				return redirect()->back();
			}else{
				if($password != $re_password){
					Session::flash('error','Mật khẩu nhập lại không đúng!');
					return redirect()->back();
				}else{
					$user = new AdminModel();
					$password = sha1(md5($password));
					$user->updateData('user',['id' => Session::get('user')->id],['password' => $password]);
					Session::flush();
					Session::flash('success','Thay đổi mật khẩu thành công, mời đăng nhập lại!');
					return redirect('admin');
				}
			}
		}
	}

}
