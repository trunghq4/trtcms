<?php namespace App\Http\Controllers\frontend\home;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB,Session,Cart,Whois,Mail,Socialite,Image,Helper;
use App\model\FHomeModel;
use App\model\FProductModel;
use App\model\FNewsModel;
use Illuminate\Http\Request;

class HomeController extends Controller {
	

	public function index(){

		$user = new FHomeModel();
		$data['slide'] = $user->getData('image',['position' => 'slide']);
		$data['banner'] = $user->getData('image',['position' => 'banner']);
		$data['product_focus'] = $user->getProductFocus();
		$data['product_home'] = $user->getProductHome();
		$data['product_hot'] = $user->getProductHot();
		$data['image_home'] = $user->getImageProduct();
		$data['news_home'] = $user->getData('news',['home'=>1,'publish' => 1, 'lang' => Session::get('lang')],'id','desc');
		$data['cate_home'] = $user->getData('product_category',['home'=>1,'lang' => Session::get('lang')]);
		$data['cate_news_home'] = $user->getData('category',['home'=>1,'lang' => Session::get('lang')]);
		$data['all_pro'] = $user->getAllProduct();
		$data['all_news'] = $user->getData('news',['publish' => 1,'lang' => Session::get('lang')],'id','desc');
		$data['page_home'] = $user->getData('pages',['lang' => Session::get('lang'),'home' => 1],'id','asc',3);

		return view('frontend.home.home',$data);
	}
	public function getAlias($alias){
		$func = new FHomeModel();
		$object = $func->getFirstRowWhere('alias',['alias' => $alias]);
		$user = new FProductModel();
		$news = new FNewsModel();
		if(count($object) > 0){
			if($object->product != 0){
				$data['product'] = $user->getProductByAlias($alias);
				$view_count = $data['product']->view_count;
				$view_count++;
				$user->updateData('product',['id' => $data['product']->id],['view_count' => $view_count]);
				$data['cate_current'] = $user->getFirstRowWhere('product_category',['id' => $data['product']->category_id]);
				if($data['cate_current']->parent_id != 0){
					$data['cate_root'] = $user->getFirstRowWhere('product_category',['id' => $data['cate_current']->parent_id]);
				}
				$data['image'] = $user->getData('image',['id_product' => $data['product']->id]);
				$data['similar_product']= $user->getProductSimilar($data['product']->id,8);
				return view('frontend.product.product',$data);
			}elseif($object->product_cate != 0){
				$data['cate_current'] = $user->getFirstRowWhere('product_category',['alias' => $alias, 'lang' => Session::get('lang')]);
				if($data['cate_current']->parent_id != 0){
					$data['cate_root'] = $user->getFirstRowWhere('product_category',['id' => $data['cate_current']->parent_id]);
				}
				$data['product'] = $user->getProductByCate($data['cate_current']->id,1);
				$data['image_product'] = $func->getImageProduct();
				return view('frontend.product.product_category',$data);
			}elseif($object->provider != 0){
				$data['provider'] = $user->getFirstRowWhere('product_provider',['alias' => $alias, 'lang' => Session::get('lang')]);
				$data['product'] = $user->getProductByProvider($data['provider']->id);
				return view('frontend.product.product_provider',$data);
			}elseif($object->product_country !=0){
				$data['product_country'] = $user->getFirstRowWhere('product_country',['alias' => $alias, 'lang' => Session::get('lang')]);
				$data['product'] = $user->getProductByCountry($data['product_country']->id);
				return view('frontend.product.product_country',$data);
			}elseif($object->news != 0){
				$data['news'] = $news->getNewsByAlias($alias);
				$view_count = $data['news']->view_count;
				$view_count++;
				$news->updateData('news',['id' => $data['news']->id],['view_count' => $view_count]);
				$data['similar'] = DB::table('news')->where('id','!=',$data['news']->id)->where(['publish' => 1,'category_id'=>$data['news']->category_id])->orderby('id','desc')->paginate(6);
				return view('frontend.news.news',$data);
			}elseif($object->news_cate !=0){
				$data['cate_current'] = $news->getFirstRowWhere('category',['alias' => $alias, 'lang' => Session::get('lang')]);
				$data['news'] = $news->getNewsByCategory($data['cate_current']->id,12);
				return view('frontend.news.news_category',$data);
			}elseif($object->page != 0){
				$data['page'] = $user->getFirstRowWhere('pages',['alias' => $alias, 'lang' => Session::get('lang')]);
				$view_count = $data['page']->view_count;
				$view_count++;
				$user->updateData('pages',['id' => $data['page']->id],['view_count' => $view_count]);
				return view('frontend.page.page',$data);
			}else{
				return view('errors.notfound');
			}
		}else{
			return view('errors.notfound');
		}
	}

}
