<?php namespace App\Http\Controllers\frontend\shoppingcart;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\BaseModel;
use App\model\MailModel;
use DB,Session,Cart,Whois,Mail,Socialite,Image;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller {

	public function index(){
		$data['cart'] = Cart::content();
		return view('frontend.shoppingcart.shoppingcart',$data);
	}
	public function destroy(){
		Cart::destroy();
		return redirect(url());
	}
	public function remove($rowid){
		Cart::remove($rowid);
		return redirect()->back();
	}
	public function payment(Request $request){
		$user = new BaseModel();
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$note = $_POST['note'];
		$total_price = Cart::total();
		$content = json_encode(Cart::content());
		$arr = [
			'name' => $name,
			'email' => $email,
			'phone' => $phone,
			'address' => $address,
			'note' => $note,
			'time' => time(),
			'content' => $content,
			'total_price' => $total_price,
			'status' => 1,
		];
		$user->insertData('order',$arr);
		$data = ['total_price' => $total_price]; // để chuyền vào view
		Mail::send('admin.mail.mail',$data,function($msg){
			$msg->from('trtcms.mail@gmail.com','Khách hàng mua hàng');
			$msg->to($_POST['email'])->subject('Mua hàng thành công');
		});
		Cart::destroy();
		return redirect(url());
	}

}
