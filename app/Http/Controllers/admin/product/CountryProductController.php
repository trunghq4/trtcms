<?php namespace App\Http\Controllers\admin\product;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use DB,Session,Schema;
use Illuminate\Http\Request;

class CountryProductController extends Controller {

	public function index(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->product_cate == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				return view('admin.product.listcountry');
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
				return view('admin.product.addcountry');
			}
		}
	}
	public function postadd(){
		$user= new AdminModel();
		$name = $_POST['name'];
		$check_name = $user->countData('product_country',['name' => $name]);
		if($check_name > 0){
			Session::flash('error','Xuất sứ đã tồn tại');
			return redirect()->back()->withInput();
		}else{
			$alias = $_POST['alias'];
			$check_alias = $user->countData('alias',['alias' => $alias]);
			if($check_alias > 0){
				Session::flash('error','Đường dẫn đã tồn tại!');
				return redirect()->back()->withInput();
			}else{
				$arr1 = [
					'name' => $name,
					'alias' => $alias,
					'time' => time(),
					'lang' => Session::get('lang')
				];
				$user->insertData('product_country',$arr1);
				$get_new = $user->getFirstRowWhere('product_country',['name' => $name]);
				$arr2 = [
					'alias' => $alias,
					'type' => 'product_country',
					'product_country' => $get_new->id,
				];
				$user->insertData('alias',$arr2);
				Session::flash('success','Thêm thành công!');
				return redirect('admin/list-country-product');
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
				$data['get_old'] = $user->getFirstRowWhere('product_country',['id' => $id]);
				return view('admin.product.editcountry',$data);
			}
		}
	}
	public function postedit($id){
		$user = new AdminModel();
		$get_old = $user->getFirstRowWhere('product_country',['id' => $id]);
		$name = $_POST['name'];
		$check_name = DB::table('product_country')->where('name',$name)->where('id','!=',$id)->count();
		if($check_name > 0){
			Session::flash('error','Tên xuất sứ đã tồn tại');
			return redirect()->back();
		}else{
			$alias = $_POST['alias'];
			$get_old_alias = $user->getFirstRowWhere('alias',['alias' => $get_old->alias]);
			$check_alias = DB::table('alias')->where('alias',$alias)->where('id','!=',$get_old_alias->id)->count();
			if($check_alias > 0){
				Session::flash('Đường dẫn đã tồn tại');
				return redirect()->back();
			}else{
				$arr = [
					'name' => $name,
					'alias' => $alias,
					'time' => time(),
				];
				$user->updateData('product_country',['id' => $id],$arr);
				$user->updateData('alias',['id' => $get_old_alias->id],['alias' => $alias]);
				Session::flash('success','Sửa Thành công');
				return redirect('admin/list-country-product');
			}
		}
	}
	public function del($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->product_cate == 0 || $id == 1){
				return redirect('admin');
			}else{
				$user = new AdminModel;
				$user->deleteData('product_country',['id' => $id]);
				$user->deleteData('alias',['product_country' => $id]);
				$user->updateData('product',['country_id'=>$id],['country_id'=>1]);
				Session::flash('success','Xóa thành công');
				return redirect('admin/list-country-product');
			}

		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$product_country = $_POST['check_del'];
				$count = count($product_country);
				for($i=0;$i<$count;$i++){
					$id = $product_country[$i];
					$get_old = $user->getFirstRowWhere('product_country',['id'=>$id]);
					$user->deleteData('product_country',['id'=>$id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
					$user->updateData('product',['country_id'=>$get_old->id],['country_id'=>1]);
				}
				return redirect('admin/list-country-product');
			}else{
				return redirect('admin/list-country-product');
			}
		}
	}

}
