<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('category')
		->insert([
			'title' => 'Chưa có danh mục',
			'image' => 'public/upload/catenews/149342992120170420143048item.png',
			'thumb' => 'public/upload/catenews/thumb/149342992120170420143048item.png',
			'parent_id' => 0,
			'alias' => 'danh-muc-1',
			'time' => time(),
			'lang' => 'vi',
		]);
		DB::table('product_category')
		->insert([
			'name' => 'Chưa có danh mục',
		]);
		DB::table('product_country')
		->insert([
			'name' => 'Chưa có nguồn gốc xuất xứ',
		]);
		DB::table('product_provider')
		->insert([
			'name' => 'Chưa có hãng sản xuất',
		]);
		DB::table('recruitment_category')
		->insert([
			'position' => 'Chưa có danh mục',
		]);
		DB::table('site_option')
		->insert([
			'name' => 'Tên đơn vị',
			'logo' => 'public/upload/siteOption/1508983325.jpg',
			'favicon' => 'public/upload/siteOption/favicon/1508902386logotrtcms-d.png',
			'watermark' => 'public/upload/siteOption/watermark/1508983325.jpg',
			'statistic' => 0,
			'maintenance' => 0,
			'lang' => 'vi',
		]);
		DB::table('site_option')
		->insert([
			'name' => 'Company\'s name',
			'logo' => 'public/upload/siteOption/1508983325.jpg',
			'favicon' => 'public/upload/siteOption/favicon/1508902386logotrtcms-d.png',
			'watermark' => 'public/upload/siteOption/watermark/1508983325.jpg',
			'statistic' => 0,
			'maintenance' => 0,
			'lang' => 'en',
		]);
		DB::table('user')
		->insert([
			'account' => 'trtcmsadmin',
			'name' => 'TRTCMS Admin',
			'password' => '0916ab629c291b519381713220dc431113f2ba60',
			'level' => 1,
			'email' => 'trtcms.mail@gmail.com',
			'sort' => 0,
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
			'module' => 1,
		]);

		DB::table('module')
		->insert([
			[
				'name' => "Thành viên",
				'table_name' => "user",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Tin tức",
				'table_name' => "news",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Sản phẩm",
				'table_name' => "product",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Trang nội dung",
				'table_name' => "pages",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Tuyển dụng",
				'table_name' => "recruitment",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Quản lý ảnh",
				'table_name' => "image",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Liên hệ",
				'table_name' => "contact",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Quản lý menu",
				'table_name' => "menu",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Cấu hình hệ thống",
				'table_name' => "site_option",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Thống kê truy cập",
				'table_name' => "statistic",
				'column' => 0,
				'fields' => "",
				'publish' => 1,
			],[
				'name' => "Cấu hình mở rộng",
				'table_name' => "site_config",
				'column' => "4",
				'publish' => 1,
				'fields' => json_encode([
					'1' => [
						'name' => 'name',
						'display_name' => 'Tên cấu hình',
						'type' => 2,
						'display_type' => 0,
						'option' => "",
						"length" => 255,
					],
					'2' => [
						'name' => 'image',
						'display_name' => 'Ảnh hiển thị',
						'type' => 3,
						'display_type' => 5,
						'option' => "",
						"length" => "",
					],
					'3' => [
						'name' => 'description',
						'display_name' => 'Mô tả',
						'type' => 3,
						'display_type' => 0,
						'option' => "",
						"length" => "",
					],
					'4' => [
						'name' => 'content',
						'display_name' => 'Nội dung',
						'type' => 3,
						'display_type' => 6,
						'option' => "",
						"length" => "",
					],

				]),
			]
		]);

		DB::table('menu')
		->insert([
			'name' => 'Menu parent 1',
			'position' => 'top',
			'parent_id' => 0,
			'lang' => 'vi'
		]);
		DB::table('menu')
		->insert([
			'name' => 'Menu parent 2',
			'position' => 'top',
			'parent_id' => 0,
			'lang' => 'vi'
		]);
		DB::table('menu')
		->insert([
			'name' => 'Menu child 1',
			'position' => 'top',
			'parent_id' => 1,
			'lang' => 'vi'
		]);
		DB::table('menu')
		->insert([
			'name' => 'Menu child 2',
			'position' => 'top',
			'parent_id' => 1,
			'lang' => 'vi'
		]);
	}

}
