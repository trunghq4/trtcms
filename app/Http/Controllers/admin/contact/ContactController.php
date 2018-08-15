<?php namespace App\Http\Controllers\admin\contact;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\AdminModel;
use Session,DB,Schema;
use Illuminate\Http\Request;

class ContactController extends Controller {

	public function index(){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$data['list_contact'] = $user->getData('contact',[],'id','desc');
			return view('admin.contact.contact',$data);
		}
	}
	public function del($id){
		if(!Session::has('user') || !Schema::hasTable('user')){
			return redirect('admin');
		}else{
			$user = new AdminModel();
			$user->deleteData('contact',['id' => $id]);
			return redirect('admin/list-contact');
		}
	}
	public function delMulti(){
		if(isset($_POST['delall'])){
			$user = new AdminModel();
			if(isset($_POST['check_del'])){
				$contact = $_POST['check_del'];
				$count = count($contact);
				for($i=0;$i<$count;$i++){
					$id = $contact[$i];
					$get_old = $user->getFirstRowWhere('contact',['id'=>$id]);
					$user->deleteData('contact',['id'=>$id]);
				}
				return redirect('admin/list-contact');
			}else{
				return redirect('admin/list-contact');
			}
		}
	}

}
