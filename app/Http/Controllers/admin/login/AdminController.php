<?php namespace App\Http\Controllers\admin\login;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Schema,DB,Artisan;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminController extends Controller {

	public function getLogin(){
		if(Schema::hasTable('user')){
			if(Session::has('user')){
				return redirect('admin/dashboard');
			}else{
				return view('admin.login.login');
			}
		}else{
			return redirect('admin/firstUse');
		}
		
	}
	public function postLogin(){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$account = $_POST['account'];
			$password = sha1(md5($_POST['password']));
			$check_name = $user->countData('user',['account' => $account, 'password' => $password]);
			if($check_name == 0){
				$check_email = $user->countData('user',['email' => $account, 'password' => $password]);
				if($check_email == 0){
					Session::flash('error','Sai tên đăng nhập hoặc mật khẩu');
					return redirect()->back();
				}else{
					Session::put('user',$user->getFirstRowWhere('user',['email' => $account]));
					if(!Session::has('lang')){
						Session::put('lang','vi');
					}
					return redirect('admin/dashboard');
				}
			}else{
				Session::put('user',$user->getFirstRowWhere('user',['account' => $account]));
				if(!Session::has('lang')){
					Session::put('lang','vi');
				}
				return redirect('admin/dashboard');
			}
		}
	}
	public function logout(){
		Session::flush();
		return redirect('admin');
	}
	public function getFirstUse(){
		if(Schema::hasTable('user')){
			return redirect('admin');
		}else{
			return view('admin.login.firstUse');
		}
	}
	public function postFirstUse(){
		$name = $_POST['name'];
		$account = $_POST['account'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$re_password = $_POST['re_password'];
		if($password != $re_password){
			Session::flash('error','Mật khẩu nhập lại không đúng!');
			return redirect()->back()->withInput();
		}else{
			$password = sha1(md5($password));
			if(Schema::hasTable('module')){
				$get_module = DB::table('module')->get();
				if(count($get_module) > 0){
					foreach($get_module as $items){
						if(Schema::hasTable($items->table_name)){
							Schema::drop($items->table_name);
						}
						if(is_dir('public/upload/'.$items->table_name)){
							rmdir('public/upload/'.$items->table_name);
						}
					}
				}
			}
			$exitCode = Artisan::call('migrate:refresh', ['--force' => true,]);
			$migrate = Artisan::call('migrate', ['--path' => 'database/migrations']);
			$db_seed = Artisan::call('db:seed');
			$arr = [
				'account' => $account,
				'name' => $name,
				'password' => $password,
				'level' => 1,
				'email' => $email,
				'sort' => 0,
				'user' => 1,
				'news' => 1,
				'news_cate' => 1,
				'add_news' => 1,
				'add_news_cate' => 1,
				'edit_news' => 1,
				'edit_news_cate' => 1,
				'product' => 1,
				'product_cate' => 1,
				'add_product' => 1,
				'add_product_cate' => 1,
				'edit_product' => 1,
				'edit_product_cate' => 1,
				'page' => 1,
				'order' => 1,
				'gallery' => 1,
				'menu' => 1,
				'site_option' => 1,
				'module' => 1,
			];
			DB::table('user')->insert($arr);
			$new_user = DB::table('user')->whereAccount($account)->first();
			Session::put('user',$new_user);
			return redirect('admin/generateDB');
		}
	}
}
