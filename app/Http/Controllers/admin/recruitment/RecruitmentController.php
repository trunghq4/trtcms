<?php namespace App\Http\Controllers\admin\recruitment;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,DB,Helper,Schema;
use Illuminate\Http\Request;

class RecruitmentController extends Controller {

	public function index(){
		if (Session::has('user') && Session::get('user')->news == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['list_recruitment'] = $user->getAllRecruitment();
			return view('admin.recruitment.listrecruitment',$data);
		}else{
			return redirect('admin');
		}
	}
	public function getadd(){
		if (Session::has('user') && Session::get('user')->add_news == 1 && Schema::hasTable('user')) {
			$user = new AdminModel();
			$data['cate_recruitment'] = $user->getData('recruitment_category',['lang'=>Session::get('lang')]);
			return view('admin.recruitment.addrecruitment',$data);
		}else{
			return redirect('admin');
		}
	}
	public function postadd(){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$check_name = $user->countData('recruitment',['position' => $_POST['position']]);
			if($check_name > 0){
				Session::flash('error','Vị trí tuyển dụng đã tồn tại');
				return redirect()->back()->withInput();
			}else{
				$check_alias = $user->countData('alias',['alias' => $_POST['alias']]);
				if($check_alias > 0){
					Session::flash('error','Đường dẫn đã tồn tại');
					return redirect()->back()->withInput();
				}else{
					if($_FILES['image']['name'] != ''){
						$get_ext = explode('.',$_FILES['image']['name']);
						$ext = '.'.end($get_ext);
						$image = 'public/upload/recruitment/'.time().$ext;
						$tmp_name = $_FILES['image']['tmp_name'];
						if(!file_exists($image)){
							Image::make($tmp_name)->save($image);
						}
						$thumb = 'public/upload/recruitment/thumb/'.time().$ext;
						if(!file_exists($thumb)){
							Image::make($image)->fit(190, 190)->save($thumb);
						}
					}else{
						$image = "";
						$thumb = "";
					}
					if(isset($_POST['hot'])){
						$hot = 1;
					}else{
						$hot = 0;
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
					if($_POST['time_out'] == ""){
						Session::flash('error','Mời nhập hạn nộp hồ sơ');
						return redirect()->back()->withInput();
					}
					if(strtotime($_POST['time_out']) <= time() ){
						Session::flash('error','Hạn nộp đã hết');
						return redirect()->back()->withInput();
					}
					$arr = [
						'position' => $_POST['position'],
						'alias' => $_POST['alias'],
						'quantity' => $_POST['quantity'],
						'salary' => $_POST['salary'],
						'experience' => $_POST['experience'],
						'category_id' => $_POST['category_id'],
						'diploma' => $_POST['diploma'],
						'description' => $_POST['description'],
						'benefit' => $_POST['benefit'],
						'requirement' => $_POST['requirement'],
						'profile' => $_POST['profile'],
						'image' => $image,
						'thumb' => $thumb,
						'time_out' => $_POST['time_out'],
						'time' => time(),
						'hot' => $hot,
						'home' => $home,
						"focus" => $focus,
						'sort' => 0,
						'lang' => Session::get('lang'),
					];
					$user->insertData('recruitment',$arr);
					$get_new = $user->getFirstRowWhere('recruitment',['position' => $_POST['position']]);
					$arr2 = [
						'alias' => $_POST['alias'],
						'type' => 'recruitment',
						'recruitment' => $get_new->id
					];
					$user->insertData('alias',$arr2);
					Session::flash('success','Đăng tin thành công');
					return redirect(url('admin/list-recruitment'));
				}
			}
		}
	}
	public function getedit($id){
		if(!Session::has('user') || !Session::get('user')->edit_news == 1 || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$data['get_old'] = $user->getFirstRowWhere('recruitment',['id' => $id]);
			$data['cate_recruitment']= $user->getData('recruitment_category',['lang' => Session::get('lang')]);
			return view('admin.recruitment.editrecruitment',$data);
		}
	}
	public function postedit($id){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('recruitment',['id' => $id]);
			$check_name = DB::table('recruitment')->where('id','!=',$id)->where('position',$_POST['position'])->count();
			if($check_name > 0){
				Session::flash('error','Vị trí tuyển dụng đã tồn tại');
				return redirect()->back();
			}else{
				$check_alias = DB::table('alias')->where('recruitment','!=',$id)->where('alias',$_POST['alias'])->count();
				if($check_alias > 0){
					Session::flash('error','Đường dẫn đã tồn tại');
					return redirect()->back();
				}else{
					if($_FILES['image']['name'] != ''){
						if(file_exists($get_old->image)){
							unlink($get_old->image);
						}
						if(file_exists($get_old->thumb)) {
							unlink($get_old->thumb);
						}
						$get_ext = explode('.',$_FILES['image']['name']);
						$ext = '.'.end($get_ext);
						$image = 'public/upload/recruitment/'.time().$ext;						
						$tmp_name = $_FILES['image']['tmp_name'];
						if(!file_exists($image)){
							Image::make($tmp_name)->save($image);
						}
						$thumb = 'public/upload/recruitment/thumb/'.time().str_replace(" ","-",Helper::vn_str_filter($_FILES['image']['name']));
						if(!file_exists($thumb)){
							Image::make($image)->fit(190, 190)->save($thumb);
						}
					}else{
						$image = $get_old->image;
						$thumb = $get_old->thumb;
					}
					if(isset($_POST['hot'])){
						$hot = 1;
					}else{
						$hot = 0;
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
					$arr = [
						'position' => $_POST['position'],
						'alias' => $_POST['alias'],
						'quantity' => $_POST['quantity'],
						'salary' => $_POST['salary'],
						'experience' => $_POST['experience'],
						'category_id' => $_POST['category_id'],
						'diploma' => $_POST['diploma'],
						'description' => $_POST['description'],
						'benefit' => $_POST['benefit'],
						'requirement' => $_POST['requirement'],
						'profile' => $_POST['profile'],
						'image' => $image,
						'thumb' => $thumb,
						'time_out' => $_POST['time_out'],
						'time' => time(),
						'hot' => $hot,
						'home' => $home,
						"focus" => $focus,
						'sort' => 0,
						'lang' => Session::get('lang'),
					];
					$user->updateData('recruitment',['id' => $id],$arr);
					$user->updateData('alias',['recruitment' => $id],['alias' => $_POST['alias']]);
					Session::flash('success','Sửa tin thành công');
					return redirect(url('admin/list-recruitment'));
				}
			}
		}
	}
	public function del($id){
		if (!Session::has('user') || Session::get('user')->edit_news == 0 || !Schema::hasTable('user')) {
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$get_old = $user->getFirstRowWhere('recruitment',['id'=>$id]);
			if(file_exists($get_old->image)){
				unlink($get_old->image);
			}
			if(file_exists($get_old->thumb)){
				unlink($get_old->thumb);
			}
			$user->deleteData('recruitment',['id' => $id]);
			$user->deleteData('alias',['recruitment' => $id]);
			Session::flash('success','Xóa bài viết thành công');
			return redirect('admin/list-recruitment');
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$recruitment = $_POST['check_del'];
				$count = count($recruitment);
				for($i=0;$i<$count;$i++){
					$id = $recruitment[$i];
					$get_old = $user->getFirstRowWhere('recruitment',['id'=>$id]);
					if(file_exists($get_old->thumb)){
						unlink($get_old->thumb);
					}
					if(file_exists($get_old->image)){
						unlink($get_old->image);
					}
					$user->deleteData('recruitment',['id'=>$id]);
					$user->deleteData('alias',['alias' => $get_old->alias]);
				}
				return redirect('admin/list-recruitment');
			}else{
				return redirect('admin/list-recruitment');
			}
		}
	}

}
