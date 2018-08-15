<?php namespace App\Http\Controllers\admin\recruitment;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,DB,Schema;
use Illuminate\Http\Request;

class CategoryRecruitmentController extends Controller {

	public function index(){
		if (Session::has('user') && Session::get('user')->news_cate == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['list_cate'] = $user->getData('recruitment_category',['lang' => Session::get('lang')]);
			return view('admin.recruitment.listcate',$data);
		}else{
			return redirect('admin');
		}
	}
	public function getadd(){
		if (Session::has('user') && Session::get('user')->add_news_cate == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			return view('admin.recruitment.addcate');
		}else{
			return redirect('admin');
		}
	}
	public function postadd(){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$check_name = $user->countData('recruitment_category',['position' => $_POST['position']]);
			if($check_name > 0){
				Session::flash('error','Tiêu đề đã tồn tại!');
				return redirect()->back()->withInput();
			}else{
				$check_alias = $user->countData('alias',['alias' => $_POST['alias']]);
				if($check_alias > 0){
					Session::flash('error','Đường dẫn đã tồn tại!');
					return redirect()->back()->withInput();
				}else{
					if(isset($_POST['hot'])){
						$hot = 1;
					}else{
						$hot = 0;
					}
					$arr = [
						'position' => $_POST['position'],
						'alias' => $_POST['alias'],
						'hot' => $hot,
						'lang' => Session::get('lang')
					];
					$user->insertData('recruitment_category',$arr);
					$get_new = $user->getFirstRowWhere('recruitment_category',['position' => $_POST['position']]);
					$arr2 = [
						'alias' => $_POST['alias'],
						'type' => 'recruitment_category',
						'recruitment_cate' => $get_new->id
					];
					$user->insertData('alias',$arr2);
					Session::flash('success','Thêm danh mục thành công');
					return redirect(url('admin/list-recruitment-category'));
				}
			}
		}
	}
	public function getedit($id){
		if(Session::has('user') && Session::get('user')->edit_news_cate == 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$data['get_old'] = $user->getFirstRowWhere('recruitment_category',['id'=>$id]);
			return view('admin.recruitment.editcate',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postedit($id){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('recruitment_category',['id' => $id]);
			$check_name = DB::table('recruitment_category')->where('position',$_POST['position'])->where('id','!=',$id)->count();
			if($check_name > 0){
				Session::flash('error','Tiêu đề đã tồn tại!');
				return redirect()->back()->withInput();
			}else{
				$check_alias = DB::table('alias')->where('alias',$_POST['alias'])->where('recruitment_cate','!=',$id)->count();
				if($check_alias > 0){
					Session::flash('error','Đường dẫn đã tồn tại!');
					return redirect()->back()->withInput();
				}else{
					if(isset($_POST['hot'])){
						$hot = 1;
					}else{
						$hot = 0;
					}
					$arr = [
						'position' => $_POST['position'],
						'alias' => $_POST['alias'],
						'hot' => $hot,
					];
					$user->updateData('recruitment_category',['id' => $id],$arr);
					$user->updateData('alias',['recruitment_cate' => $id],['alias' => $_POST['alias']]);
					Session::flash('success','Sửa danh mục thành công');
					return redirect(url('admin/list-recruitment-category'));
				}
			}
		}
	}
	public function del($id){
		if(Session::has('user') && Session::get('user')->edit_news_cate == 1 && $id != 1 && Schema::hasTable('user')){
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('recruitment_category',['id'=>$id]);
			$user->updateData('recruitment',['category_id' => $id],['category_id' => 1]);
			$user->deleteData('alias',['alias' => $get_old->alias]);
			$user->deleteData('recruitment_category',['id' => $id]);
			Session::flash('success','Xóa danh mục thành công!');
			return redirect('admin/list-recruitment-category');
		}else{
			return redirect('admin');
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
					$get_old = $user->getFirstRowWhere('recruitment_category',['id'=>$id]);
					$user->deleteData('recruitment_category',['id'=>$id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
					$user->updateData('recruitment',['category_id' => $id],['category_id' => 1]);
				}
				return redirect('admin/list-recruitment-category');
			}else{
				return redirect('admin/list-recruitment-category');
			}
		}
	}

}
