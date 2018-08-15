<?php namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request,Session,DB,Helper;
use App\model\BaseModel;
use App\model\AdminModel;
use Artisan;
// use Illuminate\Http\Request;

class AjaxController extends Controller {

	public function getAlias($str){
		if(Request::ajax()){
			$alias = Helper::make_alias(trim($str));
			echo $alias;
		}
	}
	public function getEditRecruitmentCateHome($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('recruitment_category',['id' => $id]);
			if($get_cate->hot == 1){
				$hot = 0;
			}else{
				$hot = 1;
			}
			$arr = ['hot' => $hot];
			$user->updateData('recruitment_category',['id' => $id],$arr);
		}
	}
	public function getEditRecruitmentHome($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('recruitment',['id' => $id]);
			if($get_cate->home == 1){
				$home = 0;
			}else{
				$home = 1;
			}
			$arr = ['home' => $home];
			$user->updateData('recruitment',['id' => $id],$arr);
		}
	}

	public function getEditRecruitmentHot($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('recruitment',['id' => $id]);
			if($get_cate->hot == 1){
				$hot = 0;
			}else{
				$hot = 1;
			}
			$arr = ['hot' => $hot];
			$user->updateData('recruitment',['id' => $id],$arr);
		}
	}
	public function getEditRecruitmentFocus($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('recruitment',['id' => $id]);
			if($get_cate->focus == 1){
				$focus = 0;
			}else{
				$focus = 1;
			}
			$arr = ['focus' => $focus];
			$user->updateData('recruitment',['id' => $id],$arr);
		}
	}
	public function getEditRecruitmentSort($id,$num){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('recruitment',['id' => $id]);
			$user->updateData('recruitment',['id'=>$id],['sort'=>$num]);
		}
	}

	public function getEditNewsCateHome($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('category',['id' => $id]);
			if($get_cate->home == 1){
				$home = 0;
			}else{
				$home = 1;
			}
			$arr = ['home' => $home];
			$user->updateData('category',['id' => $id],$arr);
		}
	}
	public function getEditNewsCateHot($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('category',['id' => $id]);
			if($get_cate->hot == 1){
				$hot = 0;
			}else{
				$hot = 1;
			}
			$arr = ['hot' => $hot];
			$user->updateData('category',['id' => $id],$arr);
		}
	}
	public function getEditNewsCateFocus($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('category',['id' => $id]);
			if($get_cate->focus == 1){
				$focus = 0;
			}else{
				$focus = 1;
			}
			$arr = ['focus' => $focus];
			$user->updateData('category',['id' => $id],$arr);
		}
	}
	public function getEditNewsCateSort($id,$num){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('category',['id' => $id]);
			$user->updateData('category',['id'=>$id],['sort'=>$num]);
		}
	}

	public function getEditNewsPublish($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('news',['id' => $id]);
			if($get_cate->publish == 1){
				$publish = 0;
			}else{
				$publish = 1;
			}
			$arr = ['publish' => $publish];
			$user->updateData('news',['id' => $id],$arr);
		}
	}
	public function getEditNewsHome($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('news',['id' => $id]);
			if($get_cate->home == 1){
				$home = 0;
			}else{
				$home = 1;
			}
			$arr = ['home' => $home];
			$user->updateData('news',['id' => $id],$arr);
		}
	}

	public function getEditNewsHot($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('news',['id' => $id]);
			if($get_cate->hot == 1){
				$hot = 0;
			}else{
				$hot = 1;
			}
			$arr = ['hot' => $hot];
			$user->updateData('news',['id' => $id],$arr);
		}
	}
	public function getEditNewsFocus($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('news',['id' => $id]);
			if($get_cate->focus == 1){
				$focus = 0;
			}else{
				$focus = 1;
			}
			$arr = ['focus' => $focus];
			$user->updateData('news',['id' => $id],$arr);
		}
	}
	public function getEditNewsSort($id,$num){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('news',['id' => $id]);
			$user->updateData('news',['id'=>$id],['sort'=>$num]);
		}
	}

	public function getEditProductCateHome($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product_category',['id' => $id]);
			if($get_cate->home == 1){
				$home = 0;
			}else{
				$home = 1;
			}
			$arr = ['home' => $home];
			$user->updateData('product_category',['id' => $id],$arr);
		}
	}

	public function getEditProductCateHot($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product_category',['id' => $id]);
			if($get_cate->hot == 1){
				$hot = 0;
			}else{
				$hot = 1;
			}
			$arr = ['hot' => $hot];
			$user->updateData('product_category',['id' => $id],$arr);
		}
	}
	public function getEditProductCateFocus($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product_category',['id' => $id]);
			if($get_cate->focus == 1){
				$focus = 0;
			}else{
				$focus = 1;
			}
			$arr = ['focus' => $focus];
			$user->updateData('product_category',['id' => $id],$arr);
		}
	}
	public function getEditProductCateSort($id,$num){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product_category',['id' => $id]);
			$user->updateData('product_category',['id'=>$id],['sort'=>$num]);
		}
	}

	public function getEditProductHome($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product',['id' => $id]);
			if($get_cate->home == 1){
				$home = 0;
			}else{
				$home = 1;
			}
			$arr = ['home' => $home];
			$user->updateData('product',['id' => $id],$arr);
		}
	}

	public function getEditProductHot($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product',['id' => $id]);
			if($get_cate->hot == 1){
				$hot = 0;
			}else{
				$hot = 1;
			}
			$arr = ['hot' => $hot];
			$user->updateData('product',['id' => $id],$arr);
		}
	}
	public function getEditProductFocus($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product',['id' => $id]);
			if($get_cate->focus == 1){
				$focus = 0;
			}else{
				$focus = 1;
			}
			$arr = ['focus' => $focus];
			$user->updateData('product',['id' => $id],$arr);
		}
	}
	public function getEditProductNew($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product',['id' => $id]);
			if($get_cate->new == 1){
				$new = 0;
			}else{
				$new = 1;
			}
			$arr = ['new' => $new];
			$user->updateData('product',['id' => $id],$arr);
		}
	}
	public function getEditProductActive($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product',['id' => $id]);
			if($get_cate->active == 1){
				$active = 0;
			}else{
				$active = 1;
			}
			$arr = ['active' => $active];
			$user->updateData('product',['id' => $id],$arr);
		}
	}
	public function getEditProductSort($id,$num){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('product',['id' => $id]);
			$user->updateData('product',['id'=>$id],['sort'=>$num]);
		}
	}
	public function getEditPageHome($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('pages',['id' => $id]);
			if($get_cate->home == 1){
				$home = 0;
			}else{
				$home = 1;
			}
			$arr = ['home' => $home];
			$user->updateData('pages',['id' => $id],$arr);
		}
	}
	public function getEditPageHot($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('pages',['id' => $id]);
			if($get_cate->hot == 1){
				$hot = 0;
			}else{
				$hot = 1;
			}
			$arr = ['hot' => $hot];
			$user->updateData('pages',['id' => $id],$arr);
		}
	}
	public function getEditPageFocus($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('pages',['id' => $id]);
			if($get_cate->focus == 1){
				$focus = 0;
			}else{
				$focus = 1;
			}
			$arr = ['focus' => $focus];
			$user->updateData('pages',['id' => $id],$arr);
		}
	}

	public function getEditPageSort($id,$num){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_cate = $user->getFirstRowWhere('pages',['id' => $id]);
			$user->updateData('pages',['id'=>$id],['sort'=>$num]);
		}
	}
	public function showUploadImage(){
		if(Request::ajax()){
			Helper::remove_allFile('public/upload/ajax');
			if(is_array($_FILES['image']['name'])){
				$count = count($_FILES['image']['name']);
				$result = "";
				for($i=0;$i<$count;$i++){
					$image = 'public/upload/ajax/'.$_FILES['image']['name'][$i];
					$tmp_name = $_FILES['image']['tmp_name'][$i];
					move_uploaded_file($tmp_name, $image);
					$result .= "<img src='".url($image)."' class='img-thumbnail' style='float:left'>";
				}
				echo $result;
			}else{
				$image = 'public/upload/ajax/'.$_FILES['image']['name'];
				$tmp_name = $_FILES['image']['tmp_name'];
				move_uploaded_file($tmp_name, $image);
				echo "<img src='".url($image)."' class='img-thumbnail'>";
			}
		}
	}
	public function userCheck($level){
		if(Request::ajax()){
			if($level == 1){
				$data = [
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
				];
			}elseif($level == 2){
				$data = [
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
					'order' => 1,
					'page' => 1,
					'gallery' => 0,
					'menu' => 0,
					'site_option' => 0,
				];
			}elseif($level == 3){
				$data = [
					'user' => 0,
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
					'order' => 0,
					'page' => 1,
					'gallery' => 0,
					'menu' => 0,
					'site_option' => 0,
				];
			}elseif($level == 4){
				$data = [
					'user' => 0,
					'news' => 1,
					'news_cate' => 1,
					'add_news' => 1,
					'add_news_cate' => 1,
					'edit_news' => 0,
					'edit_news_cate' => 0,
					'product' => 1,
					'product_cate' => 1,
					'add_product' => 1,
					'add_product_cate' => 1,
					'edit_product' => 0,
					'edit_product_cate' => 0,
					'order' => 0,
					'page' => 1,
					'gallery' => 0,
					'menu' => 0,
					'site_option' => 0,
				];
			}else{
				$data = [
					'user' => 0,
					'news' => 0,
					'news_cate' => 0,
					'add_news' => 0,
					'add_news_cate' => 0,
					'edit_news' => 0,
					'edit_news_cate' => 0,
					'product' => 0,
					'product_cate' => 0,
					'add_product' => 0,
					'add_product_cate' => 0,
					'edit_product' => 0,
					'edit_product_cate' => 0,
					'order' => 0,
					'page' => 0,
					'gallery' => 0,
					'menu' => 0,
					'site_option' => 0,
				];
			}
			die (json_encode($data));
		}
	}
	public function postAddCate(){
		if(Request::ajax()){
			$user = new BaseModel();
			$name = $_POST['name'];
			$check_name = $user->countData('product_category',['name' => $name]);
			if($check_name > 0){
				$list_procate = $user->getData('product_category',['lang' => Session::get('lang')]);
				$data = "";
				$get_old = $user->getFirstRowWhere('product_category',['name' => $name]);
				echo '<option value="0">Chọn danh mục</option>';
				$data2 ="";
				foreach($list_procate as $items):
					if($items->parent_id == 0 && $items->id>1):
						$select = "";
						if($items->id == $get_old->id){
							$select = "selected";
						}
						echo '<option value="'.$items->id.'" '.$select.'>
						'.$items->name.'
						</option>';
						Helper::sub_menu_pro_ajax($list_procate,$items->id,$get_old);
					endif;
				endforeach;
			}else{
				$parent_id = $_POST['parent_id'];
				$alias = Helper::make_alias($name);
				$check_alias = $user->countData('alias',['alias'=>$alias]);
				if($check_alias > 0 ){
					$list_procate = $user->getData('product_category',['lang' => Session::get('lang')]);
					foreach($list_procate as $items):
						if($items->parent_id == 0 && $items->id>1):
							$select = "";
							echo '<option value="'.$items->id.'" '.$select.'>
							'.$items->name.'
							</option>';
							Helper::sub_menu_pro_ajax($list_procate,$items->id);
						endif;
					endforeach;
				}else{
					$arr = [
						'name' => $name,
						'parent_id' => $parent_id,
						'alias' => $alias,
						'lang' => Session::get('lang'),
						'time' => time(),
					];
					$user->insertData('product_category',$arr);
					$get_new = $user->getFirstRowWhere('product_category',['name' => $name]);
					$user->insertData('alias',[
						'alias' => $alias,
						'type' => 'catepro',
						'product_cate' => $get_new->id,
					]);
					$list_procate = $user->getData('product_category',['lang' => Session::get('lang')]);
					$data = "";
					echo '<option value="0">Không có danh mục</option>';
					foreach($list_procate as $items):
						if($items->parent_id == 0 && $items->id>1):
							$select = "";
							if($items->id == $get_new->id){
								$select = "selected";
							}
							echo '<option value="'.$items->id.'" '.$select.'>
							'.$items->name.'
							</option>';
							Helper::sub_menu_pro_ajax($list_procate,$items->id,$get_new);
						endif;
					endforeach;
				    // $data .= '</select>';
				}
			}
			// echo $data;
		}
	}
	public function postAddProvider(){
		if(Request::ajax()){
			$user = new BaseModel();
			$name = $_POST['name'];
			$check_name = $user->countData('product_provider',['name' => $name]);
			if($check_name > 0){
				$list_provider = $user->getData('product_provider',['lang' => Session::get('lang')]);
				$data = "";
				$data .= '<option value="1">Chọn hãng sản xuất</option>';
				foreach ($list_provider as $key => $value):
					if($value->id > 1):
						$data .= '<option value="'.$value->id.'" class="form-control"';
						if($value->name == $name){
							$data .= 'selected';
						}
						$data .= '>'.$value->name.'</option>';
					endif;
				endforeach;
			}else{
				$alias = Helper::make_alias($name);
				$check_alias = $user->countData('alias',['alias'=>$alias]);
				if($check_alias > 0 ){
					$list_provider = $user->getData('product_provider',['lang' => Session::get('lang')]);
					$data = "";
					$data .= '<option value="1">Chọn hãng sản xuất</option>';
					foreach ($list_provider as $key => $value):
						if($value->id > 1):
							$data .= '<option value="'.$value->id.'" class="form-control"';
							$data .= '>'.$value->name.'</option>';
						endif;
					endforeach;
				}else{
					$arr = [
						'name' => $name,
						'alias' => $alias,
						'time' => time(),
						'lang' => Session::get('lang'),
					];
					$user->insertData('product_provider',$arr);
					$get_new = $user->getFirstRowWhere('product_provider',['name' => $name]);
					$user->insertData('alias',[
						'alias' => $alias,
						'type' => 'provider',
						'provider' => $get_new->id,
					]);
					$list_provider = $user->getData('product_provider',['lang' => Session::get('lang')]);
					$data = "";
					$data .= '<option value="1">Chọn hãng sản xuất</option>';
					foreach ($list_provider as $key => $value):
						if($value->id > 1):
							$data .= '<option value="'.$value->id.'" class="form-control"';
							if($get_new->id == $value->id):
								$data .= 'selected';
							endif;
							$data .= '>'.$value->name.'</option>';
						endif;
					endforeach;
				}
			}
			echo $data;
		}
	}
	public function postAddCountry(){
		if(Request::ajax()){
			$user = new BaseModel();
			$name = $_POST['name'];
			$check_name = $user->countData('product_country',['name' => $name]);
			if($check_name > 0){
				$list_country = $user->getData('product_country',['lang' => Session::get('lang')]);
				$data = "";
				$data .= '<option value="1">Nguồn gốc xuất sứ</option>';
				foreach ($list_country as $key => $value):
					if($value->id > 1):
						$data .= '<option value="'.$value->id.'" class="form-control"';
						if($value->name == $name){
							$data .= 'selected';
						}
						$data .= '>'.$value->name.'</option>';
					endif;
				endforeach;
			}else{
				$alias = Helper::make_alias($name);
				$check_alias = $user->countData('alias',['alias'=>$alias]);
				if($check_alias > 0 ){
					$list_country = $user->getData('product_country',['lang' => Session::get('lang')]);
					$data = "";
					$data .= '<option value="1">Nguồn gốc xuất sứ</option>';
					foreach ($list_country as $key => $value):
						if($value->id > 1):
							$data .= '<option value="'.$value->id.'" class="form-control"';
							$data .= '>'.$value->name.'</option>';
						endif;
					endforeach;
				}else{
					$arr = [
						'name' => $name,
						'alias' => $alias,
						'time' => time(),
						'lang' => Session::get('lang'),
					];
					$user->insertData('product_country',$arr);
					$get_new = $user->getFirstRowWhere('product_country',['name' => $name]);
					$user->insertData('alias',[
						'alias' => $alias,
						'type' => 'product_country',
						'product_country' => $get_new->id,
					]);
					$list_country = $user->getData('product_country',['lang' => Session::get('lang')]);
					$data = "";
					$data .= '<option value="1">Nguồn gốc xuất sứ</option>';
					foreach ($list_country as $key => $value):
						if($value->id > 1):
							$data .= '<option value="'.$value->id.'" class="form-control"';
							if($get_new->id == $value->id):
								$data .= 'selected';
							endif;
							$data .= '>'.$value->name.'</option>';
						endif;
					endforeach;
				}
			}
			echo $data;
		}
	}
	public function displayContact($id){
		if(Request::ajax()){
			$user = new BaseModel();
			$get_contact = $user->getFirstRowWhere('contact',['id' => $id]);
			if($get_contact->display == 1){
				$display = 0;
			}else{
				$display = 1;
			}
			$user->updateData('contact',['id' => $id],['display' => $display]);
		}
	}
	public function checkOrder($id,$status){
		if(Request::ajax()){
			$user = new BaseModel();
			$order = $user->getFirstRowWhere('order',['id' => $id]);
			$arr = ['status' => $status,'admin' => Session::get('user')->name];
			$user->updateData('order',['id'=>$id],$arr);
		}
	}
	public function listNewsLoadMore($i){
		if(Request::ajax()){
			$user = new AdminModel();
			$paginate = 10 + $i;
			$list_news = $user->getAllNews($paginate);
			$data = "";
			foreach($list_news as $items):
				$data  .= '<tr class="list_news">';
				$data .= '<td>';
				$data .= '<th><input type="checkbox" class="check_del" name="check_del[]" value="'.$items->id.'"></th>';
				$data .= '</td>';
				$data .= '<td>'.$items->id.'</td>';
				if(Session::get('user')->edit_news == 1):
					$data .= '<td><input style="width:50px;" type="text" id_news="'.$items->id.'" name="sort" value="'.$items->sort.'"></td>';
				endif;
				$data .= '<td>'.$items->title.'</td>';
				$data .= '<td><img style="width:100px" class="img-thumbnail" src="'.url($items->thumb).'"></td>';
				$data .= '<td>';
				if($items->category_id > 0):
					$data .= $items->cate_title;
				else: 
					$data .= 'Chưa có danh mục';
				endif;
				$data .= '</td>';
				$data .= '<td><input type="checkbox" name="publish" id_news="'.$items->id.'"'; 
				if($items->publish == 1):
					$data .= 'checked '; 
				endif;
				$data .= 'title="Xuất bản"></td>';
				if(Session::get('user')->edit_news == 1):
					$data .= '<td><div class="form-group">';
					$data .= '<label class="label-success col-md-10 col-xs-10 col-sm-10" style="color: #fff">Trang chủ</label>';
					$data .= '<input type="checkbox" name="home" class="col-md-2 col-xs-2 col-sm-2" id_news="{{$items->id}}"';
					if($items->home == 1):
						$data .= 'checked ';
					endif ;
					$data .= 'title="Trang chủ">';
					$data .= '<div class="clearfix"></div>';
					$data .= '<label class="label-primary col-md-10 col-xs-10 col-sm-10" style="color: #fff">Nổi bật</label>';
					$data .= '<input type="checkbox" name="hot" class="col-md-2 col-xs-2 col-sm-2" id_news="'.$items->id.'" title="Nổi bật" ';
					if($items->hot == 1):
						$data .= 'checked '; 
					endif;  
					$data .= '>';
					$data .= '<div class="clearfix"></div>';
					$data .= '<label class="label-warning col-md-10 col-xs-10 col-sm-10" style="color: #fff">Tiêu điểm</label>';
					$data .= '<input type="checkbox" name="focus" class="col-md-2 col-xs-2 col-sm-2" id_news="'.$items->id.'" title="Tiêu điểm"';
					if($items->focus == 1):
						$data .= 'checked ';
					endif;
					$data .= '></div></td>';
				endif;
				$data .= '<td>'.date('d-m-Y',$items->time+7*3600).'</td>';
				if(Session::get('user')->edit_news == 1) :
					$data .= '<td>
					<a href="'.url('admin/edit-news/'.$items->id).'" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
					<a href="'.url('admin/del-news/'.$items->id).'" onclick="return confirm(\'Bạn chắc chắn muốn xóa!\')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a>
					</td>';
				endif;
				$data .= '</tr>';
			endforeach;
			return $data;
		}
	}
	public function sortMenu(){
		if(Request::ajax()){
			$user = new AdminModel();
			$menu = $_POST['menuval'];
			$menu = json_decode($menu);
			Helper::menu_update_position($menu);
			echo "ok";
		}
	}
	public function statisticStatusChange(){
		if(Request::ajax()){
			$user = new AdminModel();
			$site_option = $user->getFirstRowWhere('site_option',['lang' => Session::get('lang')]);
			if($site_option->statistic == 1){
				$user->updateData('site_option',['lang' => Session::get('lang')],['statistic' => 0]);
			}else{
				$user->updateData('site_option',['lang' => Session::get('lang')],['statistic' => 1]);
			}
		}
	}
	public function modulePublish($name){
		if(Request::ajax()){
			$user = new AdminModel();
			$module = $user->getFirstRowWhere('module',['table_name' => $name]);
			if($module->publish == 1){
				$user->updateData('module',['table_name' => $name],['publish' => 0]);
			}else{
				$user->updateData('module',['table_name' => $name],['publish' => 1]);
			}
			
			return "Thao tác thành công!";
		}
	}
	public function maintenanceChange(){
		if(Request::ajax()){
			$user = new AdminModel();
			$site_option = $user->getFirstRowWhere('site_option',['lang' => Session::get('lang')]);
			if($site_option->maintenance == 0){
				Artisan::call('down');
				$user->updateData('site_option',['id' => $site_option->id],['maintenance' => 1]);
			}else{
				Artisan::call('up');
				$user->updateData('site_option',['id' => $site_option->id],['maintenance' => 0]);
			}
		}
	}

}
