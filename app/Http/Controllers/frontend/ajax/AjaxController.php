<?php namespace App\Http\Controllers\frontend\ajax;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\model\BaseModel;
use App\model\AdminModel;
use App\model\FProductModel;
use Request,DB,Session,Cart,Whois,Mail,Socialite,Image,Helper;

class AjaxController extends Controller {

	public function addCart($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$product = $user->getFirstRowWhere('product',['id' => $id]);
			Cart::add(['id' => $product->id , 'name' => $product->name, 'qty' => 1, 'price' => $product->price_sale, 'options' => ['image' => $product->thumb]]);
			return Cart::count();
		}
	}
	public function updateCart($rowId,$num){
		if(Request::ajax()){
			$user = new BaseModel();
			Cart::update($rowId,$num);
			$cart = Cart::content();
			$items = $cart[$rowId]['qty']*$cart[$rowId]['price'];
			$items_price = Helper::adddotstring($items);
			$total_price = Helper::adddotstring(Cart::total());
			$result = ['items_price' => $items_price,'total_price' => $total_price];
			return redirect(url('shopping-cart'));
		}
	}
	public function removeCart($rowId){
		if(Request::ajax()){
			Cart::remove($rowId);
			$cart = Cart::content();
			$result = "";
			$result .= "<table class='table table-hover table-bordered'>";
			$result .= '<tr>
							<th>Stt</th>
							<th>Ảnh</th>
							<th>Tên sản phẩm</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Tổng</th>
							<th></th>
						</tr>';
			$result .= '<form id="frm-cart">';
			if(!empty($cart)){
				$i =0;
				foreach ($cart as $items) {
					$i++;
					$result .= '<tr>';
					$result .= '<td>'.$i.'</td>';
					$result .= '<td><img src="'.url($items->options->image).'" class="img-thumbnail"/></td>';
					$result .= '<td>'.$items->name.'</td>';
					$result .= '<td>'.$items->price.'</td>';
					$result .= '<td><input type="text" name="qty" data-rowid="'.$items->rowid.'" value="'.$items->qty.'"></td>';
					$result .= '<td class="price"><span id="price'.$items->rowid.'">'.number_format($items->price*$items->qty,0,",",".").'</span> <sup>đ</sup></td>';
					$result .= '<td><a href="javascript:void()" class="remove_cart btn btn-danger btn-xs" data-rowid="'.$items->rowId.'"><i class="fa fa-remove"></i></a></td>';
					$result .= '</tr>';
				}
			}
			$result .= '<tr>
								<td colspan="7"><strong>Tổng tiền:</strong> <span id="total_price" style="color:#ff0000">'.Helper::adddotstring(Cart::total()).'</span> <sup>đ</sup></td>
							</tr>
							<tr>
								<td colspan="7">
									<div class="form-group">
										<input type="submit" name="submit" value="Thanh toán" class="btn btn-success">
										<a href="'.url().'" class="btn btn-warning">Tiếp tục mua hàng</a>
										<a href="'.url('cart-destroy').'" class="btn btn-danger">Hủy toàn bộ giỏ hàng</a>
									</div>
								</td>
							</tr>';
			$result .=	csrf_field();
			$result.= '</form>';
			$result .= "</table>";
			return $result;
		}
	}
	public function searchProduct($str){
		if(Request::ajax()){
			$user = new AdminModel();
			$result = $user->getProductLike($str,5);
			$string = "";
			if(!empty($result)){
				foreach ($result as $key => $value) {
					$string .= "<div class='search_items col-md-12 col-xs-12'>";
						$string .= "<a href='".url($value->alias).".html'><div class='name col-md-6 col-xs-12'>";
							$string .= $value->name;
						$string .= "</div>";
						$string .= "<div class='price col-md-6 col-xs-12 text-right hidden-xs'>";
							$string .= Helper::adddotstring($value->price_sale).'đ';
						$string .= "</div></a>";
					$string .= "</div>";
				}
			}else{
				$string .= "<div class='search_items col-md-12 col-xs-12' style='color:red'>";
					$string .= "Không tìm thấy kết quả nào ...";
				$string .= "</div>";
			}
			return $string;
		}
	}
	public function loadMoreProductCate($i,$cate_id){
		if(Request::ajax()){
			$product = new FProductModel();
			$paginate = $i+36;
			$list = $product->getProductByCate($cate_id,$paginate);
			$data = "";
			$a = 0;
			foreach($list as $items){
				$a++;
				$data .= '<div class="col-md-3 col-xs-6 m_item">';
					$data .= '<div class="m_img"><a href="'.url($items->alias).'.html"><img src="'.url($items->thumb).'"></a></div>';
					$data .= '<div class="m_name text-center"><a href="'.url($items->alias).'.html">'.$items->name.'</a></div>';
					$data .= '<div class="m_price text-center">Chưa VAT:'.Helper::adddotstring($items->price_sale).' <sup>đ</sup></div>';
					$data .= '<div class="m_price_vat text-center">Có VAT: '.Helper::adddotstring($items->price_sale*110/100).' <sup>đ</sup></div>';
				$data .= "</div>";
				if($a%4 == 0){
					$data.= '<div class="clear"></div>';
				}
				if($i%2 == 0){
					$data .= '<div class="clear hidden-md hidden-lg"></div>';
				}
			}
			$data .= '<div class="clear"></div>';

			echo $data;
		}
	}

}
