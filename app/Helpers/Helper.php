<?php 
namespace App\Helpers;
use Illuminate\Http\Request;
use DB,File,Auth,App,Session;
use App\model\AdminModel;
use App\model\Sitemap;
class Helper {
	public static function sub_list_newscate($data,$parent_id,$user_session=0){
		foreach($data as $items){
			$user= new AdminModel();
			$get_parent = $user->getFirstRowWhere('category',['id' => $parent_id]);
			$parent_title = $get_parent->title;
			if($items->parent_id == $parent_id){
				if ($items->thumb != "") {
					$thumb = '<img style="width:100px" class="img-thumbnail" src="'.domain.$items->thumb.'">';
				}else{
					$thumb = '';
				}
				if($items->home == 1){
					$check_home = 'checked';
				}else{
					$check_home = "";
				}
				if($items->hot == 1){
					$check_hot = 'checked';
				}else{
					$check_hot = "";
				}
				if($items->focus == 1){
					$check_focus = 'checked';
				}else{
					$check_focus = "";
				}
				if($user_session->edit_news_cate == 1){
					$sort = '<td><input style="width:50px;" type="text" id_cate="'.$items->id.'" name="sort" value="'.$items->sort.'"></td>';
					$display = '<td><div class="form-group">
						<label class="label-success col-md-10 col-xs-10 col-sm-10" style="color:#fff">Trang chủ</label>
                        <div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" class="news_cate_home" id_cate="'.$items->id.'" name="home" '.$check_home.' title="Trang chủ"></div>
                        <div class="clearfix"></div>
                        <label class="label-primary col-md-10 col-xs-10 col-sm-10" style="color:#fff">Nổi bật</label>
						<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" class="news_cate_hot" id_cate="'.$items->id.'" name="hot" '.$check_hot.' title="Nổi bật"></div>
                        <div class="clearfix"></div>
						<label class="label-warning col-md-10 col-xs-10 col-sm-10" style="color:#fff">Tiêu điểm</label>
						<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" class="news_cate_focus" id_cate="'.$items->id.'" name="focus" '.$check_focus.' title="Tiêu điểm"></div>
					</div></td>';
					$action = '<td><a href="'.domain.'admin/edit-cate-news/'.$items->id.'" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a> <a href="'.domain.'admin/del-cate-news/'.$items->id.'" onclick="return confirm(\'Bạn chắc chắn muốn xóa!\')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a></td>';
				}else{
					$sort = "";
					$display = "";
					$action = "";

				}
				echo '

				<tr>
					<td>
						<th><input type="checkbox" class="check_del flat" name="check_del[]" value="'.$items->id.'"></th>
					</td>
					<td>'.$items->id.'</td>'.$sort.'
					<td>'.$items->title.'</td>
					<td>'.$thumb.'</td>
					<td>'.$parent_title.'</td>'.$display.$action.'
				</tr>

				';
				Helper::sub_list_newscate($data,$items->id,$user_session);
			}
		}
	}
	public static function sub_list_procate($data,$parent_id,$user=0){
		foreach($data as $items){
			$func= new AdminModel();
			$get_parent = $func->getFirstRowWhere('product_category',['id' => $parent_id]);
			$parent_title = $get_parent->name;
			if($items->parent_id == $parent_id){
				if ($items->thumb != "") {
					$thumb = '<img style="width:100px" class="img-thumbnail" src="'.domain.$items->thumb.'">';
				}else{
					$thumb = '';
				}
				if($items->home == 1){
					$check_home = 'checked';
				}else{
					$check_home = "";
				}
				if($items->hot == 1){
					$check_hot = 'checked';
				}else{
					$check_hot = "";
				}
				if($items->focus == 1){
					$check_focus = 'checked';
				}else{
					$check_focus = "";
				}
				if($user == 1){
					$sort= '<td><input style="width:50px;" type="text" name="sort" id_cate="'.$items->id.'" value="'.$items->sort.'"></td>';
					$display = '<td><div class="form-group">
                    <label class="label-success col-md-10 col-xs-10 col-sm-10" style="color:#fff">Trang chủ</label>
					<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" name="home" id_cate="'.$items->id.'" '.$check_home.' title="Trang chủ"></div>
					<div class="clearfix"></div>
					<label class="label-primary col-md-10 col-xs-10 col-sm-10" style="color:#fff">Nổi bật</label>
					<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" name="hot" id_cate="'.$items->id.'" '.$check_hot.' title="Nổi bật"></div>
					<div class="clearfix"></div>
					<label class="label-warning col-md-10 col-xs-10 col-sm-10" style="color:#fff">Tiêu điểm</label>
					<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" name="focus" id_cate="'.$items->id.'" '.$check_focus.' title="Tiêu điểm"></div>
				</div></td>';
				$action = '<td><a href="'.domain.'admin/edit-cate-product/'.$items->id.'" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a> <a href="'.domain.'admin/del-cate-product/'.$items->id.'" onclick="return confirm(\'Bạn chắc chắn muốn xóa!\')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a></td>';
				}else{
					$sort= '';
					$display = '';
					$action = '';
				}
				echo '

				<tr>
					<td>
						<th><input type="checkbox" class="check_del flat" name="check_del[]" value="'.$items->id.'"></th>
					</td>
					<td>'.$items->id.'</td>'.$sort.'
					<td>'.$items->name.'</td>
					<td>'.$thumb.'</td>
					<td>'.$parent_title.'</td>'.$display.$action.'
				</tr>

				';
				Helper::sub_list_procate($data,$items->id,$user);
			}
		}
	}
	public static function check_sub($table,$parent_id){
		$func = new AdminModel();
		$count = $func->countData($table,['parent_id' => $parent_id]);
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}
	public static function make_alias($str){
		return str_slug($str);
	}
	public static function make_alias_old($str){
		$cleaner = array(
			'â'   => 'a', 'Â'   => 'A',
			'ă'   => 'a', 'Ă'   => 'A',
			'ạ'   => 'a', 'Ạ'   => 'A',
			'á'   => 'a', 'Á'   => 'A',
			'à'   => 'a', 'À'   => 'A',
			'ả'   => 'a', 'Ả'   => 'A',
			'ã'   => 'a', 'Ã'   => 'A',
			'ậ'   => 'a', 'Ậ'   => 'A',
			'ấ'   => 'a', 'Ấ'   => 'A',
			'ầ'   => 'a', 'Ầ'   => 'A',
			'ẩ'   => 'a', 'Ẩ'   => 'A',
			'ẫ'   => 'a', 'Ẫ'   => 'A',
			'ặ'   => 'a', 'Ặ'   => 'A',
			'ắ'   => 'a', 'Ắ'   => 'A',
			'ằ'   => 'a', 'Ằ'   => 'A',
			'ẳ'   => 'a', 'Ẳ'   => 'A',
			'ẵ'   => 'a', 'Ẵ'   => 'A',

			'đ'   => 'd', 'Đ'   => 'D',

			'ê'   => 'e', 'Ê'   => 'E',
			'é'   => 'e', 'É'   => 'E',
			'è'   => 'e', 'È'   => 'E',
			'ẹ'   => 'e', 'Ẹ'   => 'E',
			'ẻ'   => 'e', 'Ẻ'   => 'E',
			'ẽ'   => 'e', 'Ẽ'   => 'E',
			'ế'   => 'e', 'Ế'   => 'E',
			'ề'   => 'e', 'Ề'   => 'E',
			'ệ'   => 'e', 'Ệ'   => 'E',
			'ể'   => 'e', 'Ể'   => 'E',
			'ễ'   => 'e', 'Ễ'   => 'E',

			'í'   => 'i', 'Í'   => 'I',
			'ì'   => 'i', 'Ì'   => 'I',
			'ị'   => 'i', 'Ị'   => 'I',
			'ỉ'   => 'i', 'Ỉ'   => 'I',
			'ĩ'   => 'i', 'Ĩ'   => 'I',

			'ô'   => 'o', 'Ô'   => 'O',
			'ơ'   => 'o', 'Ơ'   => 'O',
			'ó'   => 'o', 'Ó'   => 'O',
			'ò'   => 'o', 'Ò'   => 'O',
			'ọ'   => 'o', 'Ọ'   => 'O',
			'ỏ'   => 'o', 'Ỏ'   => 'O',
			'õ'   => 'o', 'Õ'   => 'O',
			'ố'   => 'o', 'Ố'   => 'O',
			'ồ'   => 'o', 'Ồ'   => 'O',
			'ộ'   => 'o', 'Ộ'   => 'O',
			'ổ'   => 'o', 'Ổ'   => 'O',
			'ỗ'   => 'o', 'Ỗ'   => 'O',
			'ớ'   => 'o', 'Ớ'   => 'O',
			'ờ'   => 'o', 'Ờ'   => 'O',
			'ợ'   => 'o', 'Ợ'   => 'O',
			'ở'   => 'o', 'Ở'   => 'O',
			'ỡ'   => 'o', 'Ỡ'   => 'O',

			'ư'   => 'u', 'Ư'   => 'U',
			'ú'   => 'u', 'Ú'   => 'U',
			'ù'   => 'u', 'Ù'   => 'U',
			'ụ'   => 'u', 'Ụ'   => 'U',
			'ủ'   => 'u', 'Ủ'   => 'U',
			'ũ'   => 'u', 'Ũ'   => 'U',
			'ứ'   => 'u', 'Ứ'   => 'U',
			'ừ'   => 'u', 'Ừ'   => 'U',
			'ự'   => 'u', 'Ự'   => 'U',
			'ử'   => 'u', 'Ử'   => 'U',
			'ữ'   => 'u', 'Ữ'   => 'U',

			'ý'   => 'y', 'Ý'   => 'Y',
			'ỳ'   => 'y', 'Ỳ'   => 'Y',
			'ỵ'   => 'y', 'Ỵ'   => 'Y',
			'ỷ'   => 'y', 'Ỷ'   => 'Y',
			'ỹ'   => 'y', 'Ỹ'   => 'Y'
			);

		$result = $str;

		foreach ($cleaner as $a => $v){
			$result = str_replace($a, $v, $result);
		}

		$result = iconv('UTF-8','ASCII//TRANSLIT',$result);

		$result = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $result);
		$result = strtolower(trim($result, '-'));
		$result = preg_replace("/[\/_| -]+/", '-', $result);
		while (strstr($result,'--')){
			$result = str_replace('--','-',$result);
		}
		$result = trim($result,'-');

		return $result;
	}
	public static function vn_str_filter ($str){
	   $unicode = array(
	       'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
	       'd'=>'đ',
	       'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	       'i'=>'í|ì|ỉ|ĩ|ị',
	       'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	       'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	       'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
	       'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	       'D'=>'Đ',
	       'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	       'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
	       'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	       'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	       'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	       );
	    foreach($unicode as $nonUnicode=>$uni){
	       $str = preg_replace("/($uni)/i", $nonUnicode, $str);
	    }
	    return $str;
	}
	public static function substr_font($str,$number){
		if(strlen($str) < $number)
		{
			return $str;
		}
		else {
			$str=strip_tags($str);
			$str =substr($str,0,$number);
			$count_vitri=strrpos($str,' ');
			$str =substr($str,0,$count_vitri).'...';
			return $str;
		}
	}
	public static function getDescription($text, $limit) {

		$words = explode(" ",$text);

		return implode(" ",array_splice($words,0,$limit))."...";

	}
	public static function getDescriptionWord($text, $limit,$end = '...') {

		return str_limit($text,$limit,$end);

	}
	public static function adddotstring($num){
		return number_format($num,0,",",".");
	}
	public static function adddotstring_old($strNum) {

		$len = strlen($strNum);
		$counter = 3;
		$result = "";
		while ($len - $counter >= 0)
		{
			$con = substr($strNum, $len - $counter , 3);
			$result = '.'.$con.$result;
			$counter+= 3;
		}
		$con = substr($strNum, 0 , 3 - ($counter - $len) );
		$result = $con.$result;
		if(substr($result,0,1)=='.'){
			$result=substr($result,1,$len+1);
		}
		return $result;
	}

	public static function sub_menu($data,$id_parent,$id_newscate="",$tab='|-- '){
		foreach ($data as $key => $value) {
			if($value->parent_id == $id_parent){
				$select = '';
				if($value->id == $id_newscate){
					$select = ' selected ';
				}
				echo '<option value="'.$value->id.'"'.$select.'>'.$tab.$value->title.'</option>';
				Helper::sub_menu($data,$value->id,$id_newscate,$tab.'|-- ');
			}
		}

	}
	public static function check_product_to_category($id_product,$id_cate){
		$user = new AdminModel();
		$check = $user->countData('product_to_category',[
			'id_product' => $id_product,
			'id_category' => $id_cate,
		]);
		if($check > 0){
			return true;
		}
		return false;
	}
	public static function sub_menu_pro($data,$id_parent,$product=[],$tab='|-- '){
		foreach ($data as $key => $value) {
			if($value->parent_id == $id_parent){
				$select = '';
				if(@Helper::check_product_to_category($product->id,$value->id)){
					$select = ' selected ';
				}
				echo '<option value="'.$value->id.'"'.$select.'>'.$tab.$value->name.'</option>';
				Helper::sub_menu_pro($data,$value->id,$product,$tab.'|-- ');
			}
		}

	}
	public static function sub_menu_pro_ajax($data,$id_parent,$new_cate=[],$tab='|-- '){
		foreach ($data as $items) {
			if($items->parent_id == $id_parent){
				$select = "";
				if(@$items->id == @$new_cate->id){
					$select = 'selected';
				}
				echo '<option value="'.$items->id.'" '.$select.'>
					 '.$tab.$items->name.'
					 </option>';
				Helper::sub_menu_pro_ajax($data,$items->id,$new_cate,$tab.'|-- ');
			}
		}
	}
	public static function sub_add_cate($data,$id_dm,$news=[],$tab = ' |-- '){
		foreach($data as $item):
			if($item->parent_id == $id_dm){
				$select = "";
				if(@Helper::check_news_to_category($news->id,$item->id)){
					$select = "selected";
				}
				echo '<option value="'.$item->id.'"'.$select.'>'.$tab.$item->title.'</option>';
				Helper::sub_add_cate($data,$item->id,$news,$tab." |-- ");
			}
		endforeach;
	}
	public static function check_news_to_category($id_news,$id_cate){
		$user = new AdminModel();
		$get_news = $user->countData('news_to_category',['id_news' => $id_news, 'id_category' => $id_cate]);
		if($get_news > 0){
			return true;
		}
		return false;
	}
	public static function sub_add_menu($data,$id_dm,$id_dm_old="",$tab = ' |-- '){
		foreach($data as $item):
			if($item->parent_id == $id_dm){
				$select = "";
				if($id_dm_old == $item->id){
					$select = "selected";
				}
				echo '<option value="'.$item->id.'"'.$select.'>'.$tab.$item->name.'</option>';
				Helper::sub_add_menu($data,$item->id,$id_dm_old,$tab." |-- ");
			}
		endforeach;
	}
	public static function sub_add_cate_pro($data,$id_dm,$id_dm_old="",$tab = ' |-- '){
		foreach($data as $item):
			if($item->parent_id == $id_dm){
				$select = "";
				if($id_dm_old == $item->id){
					$select = "selected";
				}
				echo '<option value="'.$item->id.'"'.$select.'>'.$tab.$item->name.'</option>';
				Helper::sub_add_cate_pro($data,$item->id,$id_dm_old,$tab." |-- ");
			}
		endforeach;
	}
	public static function sub_listprocat($data,$id_dm,$tab = "<span class='glyphicon glyphicon-arrow-right'> </span> &nbsp;"){
		foreach ($data as $key => $value) {
			if($value->dm_cha == $id_dm){
				if($value->anh_thumb != ""):
					$anh_thumb = '<img src="'.url($value->anh_thumb).'">';
				else:
					$anh_thumb = "";
				endif;
				echo '

				<tr>
					<td>'.$value->id_dm.'</td>
					<td><a href="'.domain.'pro-category/'.$value->duong_dan_dm.'">'.$tab.$value->ten_dm.'</a></td>
					<td>'.get_catparent($value->dm_cha).'</td>
					<td>'.$anh_thumb.'</td>
					<td>
						<a href="'.domain.'sua-dm-sp/'.$value->id_dm.'" class="btn btn-sm btn-warning"><span class="glyphicon small glyphicon-edit"></span></a>
						<a href="'.domain.'xoa-dm-sp/'.$value->id_dm.'" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')" class="btn btn-sm btn-danger"><span class="glyphicon small glyphicon-trash"></span></a>
					</td>
				</tr>

				';
				Helper::sub_listprocat($data,$value->id_dm,$tab."&nbsp;<span class='glyphicon glyphicon-arrow-right'> </span> &nbsp;");
			}
		}
	}
	public static function get_backend_sub_menu($data,$id_parent,$tab = "|-- "){
		foreach($data as $items){
			if($items->menu_cha == $id_parent){
				echo '
				<option value="'.$items->id_menu.'">'.$tab.$items->ten_menu.'</option>
				';
				Helper::get_backend_sub_menu($data,$items->id_menu,$tab = $tab."|-- ");
			}
		}
	}
	public static function image_resize($src, $dst, $width, $height, $crop=1){

		if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

		$type = strtolower(substr(strrchr($src,"."),1));
		if($type == 'jpeg') $type = 'jpg';
		switch($type){
			case 'bmp': $img = imagecreatefromwbmp($src); break;
			case 'gif': $img = imagecreatefromgif($src); break;
			case 'jpg': $img = imagecreatefromjpeg($src); break;
			case 'png': $img = imagecreatefrompng($src); break;
			default : return "Unsupported picture type!";
		}

  // resize
		$originalW = $w;
		$originalH = $h;

		if($crop){
			if($w < $width or $h < $height) return "Picture is too small!";
			$ratio = max($width/$w, $height/$h);
			$h = $height / $ratio;
			$x = ($w - $width / $ratio) / 2;
			$w = $width / $ratio;
		}
		else{
			if($w < $width and $h < $height) return "Picture is too small!";
			$ratio = min($width/$w, $height/$h);
			$width = $w * $ratio;
			$height = $h * $ratio;
			$x = 0;
		}

		$new = imagecreatetruecolor($width, $height);

  // preserve transparency
		if($type == "gif" or $type == "png"){
			imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($new, false);
			imagesavealpha($new, true);
		}

		imagecopyresampled($new, $img, 0, 0, ($originalW - $width)/2, ($originalH - $height)/2, $width, $height, $w, $h);


		switch($type){
			case 'bmp': imagewbmp($new, $dst); break;
			case 'gif': imagegif($new, $dst); break;
			case 'jpg': imagejpeg($new, $dst); break;
			case 'png': imagepng($new, $dst); break;
		}
		return true;
	}       
	public static function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
		$imgsize = getimagesize($source_file);
		$width = $imgsize[0];
		$height = $imgsize[1];
		$mime = $imgsize['mime'];

		switch($mime){
			case 'image/gif':
			$image_create = "imagecreatefromgif";
			$image = "imagegif";
			break;

			case 'image/png':
			$image_create = "imagecreatefrompng";
			$image = "imagepng";
			$quality = 7;
			break;

			case 'image/jpeg':
			$image_create = "imagecreatefromjpeg";
			$image = "imagejpeg";
			$quality = 80;
			break;

			default:
			return false;
			break;
		}

		$dst_img = imagecreatetruecolor($max_width, $max_height);
		$src_img = $image_create($source_file);

		$width_new = $height * $max_width / $max_height;
		$height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
		if($width_new > $width){
        //cut point by height
			$h_point = (($height - $height_new) / 2);
        //copy image
			imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
		}else{
        //cut point by width
			$w_point = (($width - $width_new) / 2);
			imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
		}

		$image($dst_img, $dst_dir, $quality);

		if($dst_img)imagedestroy($dst_img);
		if($src_img)imagedestroy($src_img);
	}
	public static function random_code($num=8){
		$uniqid = uniqid();
		$rand_start = rand(1,5);
		$rand_8_char = substr($uniqid,$rand_start,$num);
		return $rand_8_char;
	}
	public static function remove_allFile($dir){
		if($handle = opendir("$dir")){
			while (false !== ($item = readdir($handle))){
				if($item != "." && $item != ".."){
					if(is_dir("$dir/$item")){
						remove_directory("$dir/$item");
					}else{
						unlink("$dir/$item");
     // echo"removing $dir/$item<br>\n";
					}
				}
			}
			closedir($handle);
		}
	}
	public static function sub_menu_menu($data,$parent_id,$auth = 0,$color = '#000'){

		$r = rand(0,128);
		$g = rand(0,128);
		$b = rand(0,128);
		$color = "rgb(".$r.",".$g.",".$b.")";
		foreach ($data as $items) {
			if ($items->parent_id == $parent_id) {
				if ($auth == 1) {
					if($items->home == 1){
						$check = 'checked';
					}else{
						$check = "";
					}
					$sort = '<input style="width:50px;" type="text" id_menu="'.$items->id.'" name="sort" value="'.$items->sort.'">';
					$home = '<input type="checkbox" name="home" id_menu="'.$items->id.'"'.$check.' title="Trang chủ">';
					$action = '<a href="'.domain.'admin/edit-menu/'.$items->id.'" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a> <a href="'.domain.'admin/del-menu/'.$items->id.'" onclick="return confirm(\'Bạn chắc chắn muốn xóa!\')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a>';
				}else{
					$sort = "";
					$home = "";
					$action = "";
				}
				if($items->icon != ""){
					$icon = '<img style="width:100px" class="img-thumbnail" src="'.domain.$items->icon.'"> ';
				}else{
					$icon = "";
				}
				echo '
				<tr>
					<td>
						<th><input type="checkbox" class="check_del" name="check_del[]" value="'.$items->id.'"></th>
					</td>
					<td>'.$items->id.'</td>
					<td>'.$sort.'</td>
					<td style="color:'.$color.';font-weight:bold;">'.$items->name.'</td>
					<td>'.$icon.'</td>
					<td><div class="form-group">
						'.$home.'
					</div></td>
					<td>'.$action.'</td>
				</tr>
				';
				Helper::sub_menu_menu($data,$items->id,$auth,$color);
			}
		}
	}
	public static function admin_menu_sub($data,$parent_id){
		foreach($data as $items){
			if($items->parent_id == $parent_id){
                echo '
					<li class="dd-item" data-id="'.$items->id.'">
						<div class="dd-handle">'.$items->name.'</div>
						<ol class="dd-list">
						<div class="menu_action">
							<a href="'.url('admin/edit-menu/'.$items->id).'" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
							<a href="'.url('admin/del-menu/'.$items->id).'" onclick="return confirm(\'Bạn chắc chắn muốn xóa?\')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
						</div>
                	';
					Helper::admin_menu_sub($data,$items->id);
				echo '
						</ol>
					</li>';
			}
		}
	}
	public static function menu_update_position($menu,$parent_id=0){
		$user = new AdminModel();
		foreach($menu as $key => $items){
			$arr = ['sort' => $key,'parent_id' => $parent_id];
			$user->updateData('menu',['id' => $items->id],$arr);
			if(isset($items->children)){
				Helper::menu_update_position($items->children,$items->id);				
			}
		}
	}
	public static function site_option(){
		$data = DB::table('site_option')->where('lang',Session::get('lang'))->first();
		return $data;
	}
	public static function updateSitemap(){
		$sitemap = new Sitemap(url('/'));
		$sitemap->setFilename('sitemap');
		$sitemap->addItem('/', '1.00', 'always');
		$sitemap->createSitemapIndex(domain, 'Today');
	}

}