<?php namespace App\Http\Controllers\admin\siteOption;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,Image,Helper,Schema;
use Illuminate\Http\Request;

class SiteOptionController extends Controller {

	public function index(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			if(Session::get('user')->site_option == 0){
				return redirect('admin');
			}else{
				$user = new AdminModel();
				$data['site_option'] = $user->getFirstRowWhere('site_option',['lang' => Session::get('lang')]);
				// dd($data['site_option']);die;
				return view('admin.siteOption.index',$data);
			}
		}
	}
	public function post(){
		if(isset($_POST['submit'])){
			$user = new AdminModel();
			$get_old = $user->getFirstRowWHERE('site_option',['lang' => Session::get('lang')]);
			$name = $_POST['name'];
			$url = $_POST['url'];
			$slogan = $_POST['slogan'];
			$description_seo = $_POST['description_seo'];
			$keyword_seo = $_POST['keyword_seo'];
			$address = $_POST['address'];
			$email = $_POST['email'];
			$facebook = $_POST['facebook'];
			$google = $_POST['google'];
			$skype = $_POST['skype'];
			$hotline1 = $_POST['hotline1'];
			$hotline2 = $_POST['hotline2'];
			$hotline3 = $_POST['hotline3'];
			$fax = $_POST['fax'];
			if($_FILES['image']['name'] == ""){
				$logo = $get_old->logo;
			}else{
				if(file_exists($get_old->logo)){
					unlink($get_old->logo);
				}
				$get_ext = explode('.',$_FILES['image']['name']);
				$ext = '.'.end($get_ext);
				$logo = 'public/upload/siteOption/'.time().$ext;
				$tmp_name = $_FILES['image']['tmp_name'];
				if(!file_exists($logo)){
					Image::make($tmp_name)->save($logo);
				}
			}
			if($_FILES['favicon']['name'] == ""){
				$favicon = $get_old->favicon;
			}else{
				if(file_exists($get_old->favicon)){
					unlink($get_old->favicon);
				}
				$get_ext2 = explode('.',$_FILES['favicon']['name']);
				$ext2 = '.'.end($get_ext2);
				$favicon_image = 'public/upload/siteOption/'.time().str_replace(" ","-",Helper::vn_str_filter($_FILES['favicon']['name']));
				$tmp_name = $_FILES['favicon']['tmp_name'];
				if(!file_exists($favicon_image)){
					move_uploaded_file($tmp_name, $favicon_image);
				}
				$favicon = 'public/upload/siteOption/favicon/'.time().$ext2;
				Image::make($favicon_image)->fit(16, 16)->save($favicon);
				if(file_exists($favicon_image)){
					unlink($favicon_image);
				}
			}
			if($_FILES['watermark']['name'] == ""){
				$watermark = $get_old->watermark;
			}else{
				$get_ext3 = explode('.',$_FILES['watermark']['name']);
				$ext3 = '.'.end($get_ext3);
				if(file_exists($get_old->watermark)){
					unlink($get_old->watermark);
				}
				$watermark = 'public/upload/siteOption/watermark/'.time().$ext3;
				$tmp_name = $_FILES['watermark']['tmp_name'];
				if(!file_exists($watermark)){
					move_uploaded_file($tmp_name, $watermark);
				}
			}
			$arr = [
				'name' => $name,
				'url' => $url,
				'slogan' => $slogan,
				'description_seo' => $description_seo,
				'keyword_seo' => $keyword_seo,
				'address' => $address,
				'email' => $email,
				'facebook' => $facebook,
				'google' => $google,
				'skype' => $skype,
				'hotline1' => $hotline1,
				'hotline2' => $hotline2,
				'hotline3' => $hotline3,
				'fax' => $fax,
				'logo' => $logo,
				'favicon' => $favicon,
				'watermark' => $watermark,
				'lang' => Session::get('lang')
			];
			$user->updateData('site_option',['id'=>$get_old->id,'lang' => Session::get('lang')],$arr);
			Session::flash('success','Cập nhật thông tin thành công');
			return redirect('admin/site-option');
		}
	}

}
