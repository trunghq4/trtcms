<?php namespace App\Http\Controllers\frontend\checkdomain;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\BaseModel;
use Whois,DB,Session;
use Illuminate\Http\Request;

class WhoisController extends Controller {

	public function index(){
		return view('frontend.checkdomain.checkdomain');
	}
	public function check(){
		$user = new Whois;
		// $r = $user->lookup('safza.vn');
		// dd($r);
		$end = $_GET['end'];
		$str = $_GET['search_domain'];
		$count = count($end);
		$data = "";
		for($i=0; $i<$count; $i++){
			$data .= '<strong style="color:red;font-size:18px;">'.$str.$end[$i].'</strong>: <br>';

			$check = $user->lookup($str.$end[$i]);
			if(@$check['regrinfo']['registered'] == 'yes'){
				$data .= 'Đã được đăng ký <br><br>';
				$ip = implode('<br>',$check['regrinfo']['domain']['nserver']);
				$info = implode('<br>',$check['rawdata']);
				$data .= '<strong>Thông tin IP:</strong> <br>'.$ip.'<br><strong>Thông tin tên miền:</strong> <br>'.$info.'<br><br>';
			}else{
				$data .= '<span style="color:blue">Chưa được đăng ký</span> <br><br>';
			}
		}
		echo $data;
	}

}
