<?php namespace App\Http\Controllers\frontend\contact;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\FContactModel;
use Session,DB;
use Illuminate\Http\Request;

class ContactController extends Controller {
	
	public function index(){
		return view('frontend.contact.contact');
	}
	public function post(){
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			$note = $_POST['note'];
			$time = time();
			$arr = [
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'note' => $note,
				'time' => $time,
			];
			$user = new FContactModel();
			$user->insertData('contact',$arr);
			return redirect('/');
		}
	}
	public function getContact(){
		$name = $_GET['name'];
		$email = $_GET['email'];
		$phone = $_GET['phone'];
		$address = $_GET['address'];
		$note = $_GET['note'];
		$arr = [
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'address' => $address,
			'note' => $note,
			'time' => time(),
		];
		if(isset($_GET['privacy'])){
			$user = new FContactModel();
			$user->insertData('contact',$arr);
			return redirect('/');
		}
	}

}
