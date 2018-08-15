<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['namespace' => 'admin'],function(){

	Route::get('admin','login\AdminController@getLogin');
	Route::post('admin','login\AdminController@postLogin');
	Route::get('admin/firstUse','login\AdminController@getFirstUse');
	Route::post('admin/firstUse','login\AdminController@postFirstUse');

	Route::group(['prefix' => 'admin'],function(){

		Route::get('logout','login\AdminController@logout');
		Route::get('dashboard','DashboardController@index');
		Route::get('sitemap-regenator','sitemap\SitemapController@regenate');

		Route::group(['namespace' => 'user'],function(){
			Route::get('list-user','UserController@index');
			Route::get('add-user','UserController@getadd');
			Route::post('add-user','UserController@postadd');
			Route::get('remove-user/{id}','UserController@del');
			Route::get('edit-user/{id}','UserController@getedit');
			Route::post('edit-user/{id}','UserController@postedit');
			Route::get('change-password','UserController@getChangePass');
			Route::post('change-password','UserController@postChangePass');
		});

		Route::group(['namespace' => 'news'],function(){
			Route::get('list-news','NewsController@index');
			Route::post('list-news','NewsController@delMulti');
			Route::get('add-news','NewsController@getadd');
			Route::post('add-news','NewsController@postadd');
			Route::get('del-news/{id}','NewsController@del');
			Route::get('edit-news/{id}','NewsController@getedit');
			Route::post('edit-news/{id}','NewsController@postedit');
			Route::get('list-news-category','CategoryNewsController@index');
			Route::post('list-news-category','CategoryNewsController@delMulti');
			Route::get('add-cate-news','CategoryNewsController@getadd');
			Route::post('add-cate-news','CategoryNewsController@postadd');
			Route::get('edit-cate-news/{id}','CategoryNewsController@getedit');
			Route::post('edit-cate-news/{id}','CategoryNewsController@postedit');
			Route::get('del-cate-news/{id}','CategoryNewsController@del');
			Route::get('search-news-cate/{id}','NewsController@searchByCate');
			Route::get('search-news-user/{id}','NewsController@searchByUser');
			Route::post('search-news','NewsController@searchByTitle');
		});

		Route::group(['namespace' => 'recruitment'],function(){
			Route::get('list-recruitment-category','CategoryRecruitmentController@index');
			Route::get('add-cate-recruitment','CategoryRecruitmentController@getadd');
			Route::post('add-cate-recruitment','CategoryRecruitmentController@postadd');
			Route::get('edit-cate-recruitment/{id}','CategoryRecruitmentController@getedit');
			Route::post('edit-cate-recruitment/{id}','CategoryRecruitmentController@postedit');
			Route::get('del-cate-recruitment/{id}','CategoryRecruitmentController@del');
			Route::post('list-recruitment-category','CategoryRecruitmentController@delMulti');
			Route::get('list-recruitment','RecruitmentController@index');
			Route::get('add-recruitment','RecruitmentController@getadd');
			Route::post('add-recruitment','RecruitmentController@postadd');
			Route::get('edit-recruitment/{id}','RecruitmentController@getedit');
			Route::post('edit-recruitment/{id}','RecruitmentController@postedit');
			Route::get('del-recruitment/{id}','RecruitmentController@del');
			Route::post('list-recruitment','RecruitmentController@delMulti');
		});

		Route::group(['namespace' => 'product'],function(){
			Route::get('list-cate-product','CategoryProductController@index');
			Route::post('list-cate-product','CategoryProductController@delMulti');
			Route::get('add-cate-product','CategoryProductController@getadd');
			Route::post('add-cate-product','CategoryProductController@postadd');
			Route::get('edit-cate-product/{id}','CategoryProductController@getedit');
			Route::post('edit-cate-product/{id}','CategoryProductController@postedit');
			Route::get('del-cate-product/{id}','CategoryProductController@del');
			Route::get('list-provider-product','ProviderProductController@index');
			Route::post('list-provider-product','ProviderProductController@delMulti');
			Route::get('add-provider-product','ProviderProductController@getadd');
			Route::post('add-provider-product','ProviderProductController@postadd');
			Route::get('edit-provider-product/{id}','ProviderProductController@getedit');
			Route::post('edit-provider-product/{id}','ProviderProductController@postedit');

			Route::get('list-country-product','CountryProductController@index');
			Route::post('list-country-product','CountryProductController@delMulti');
			Route::get('add-country-product','CountryProductController@getadd');
			Route::post('add-country-product','CountryProductController@postadd');
			Route::get('edit-country-product/{id}','CountryProductController@getedit');
			Route::post('edit-country-product/{id}','CountryProductController@postedit');
			Route::get('del-country-product/{id}','CountryProductController@del');

			Route::get('del-provider-product/{id}','ProviderProductController@del');
			Route::get('list-product','ProductController@index');
			Route::post('list-product','ProductController@delMulti');
			Route::get('add-product','ProductController@getadd');
			Route::post('add-product','ProductController@postadd');
			Route::get('edit-product/{id}','ProductController@getedit');
			Route::get('del-product/{id}','ProductController@del');
			Route::post('edit-product/{id}','ProductController@postedit');

			Route::get('search-product','ProductController@getSearch');
			Route::get('search-product-cate/{id}','ProductController@searchByCate');
			Route::get('search-product-provider/{id}','ProductController@searchByProvider');
			Route::get('search-product-country/{id}','ProductController@searchByCountry');

			Route::get('list-order','ProductController@getListOrder');
			Route::post('list-order','ProductController@delMultiOrder');
			Route::get('del-order/{id}','ProductController@delOrder');

		});


		Route::group(['namespace' => 'page'],function(){
			Route::get('list-page','PageController@index');
			Route::get('add-page','PageController@getadd');
			Route::post('add-page','PageController@postadd');
			Route::get('edit-page/{id}','PageController@getedit');
			Route::post('edit-page/{id}','PageController@postedit');
			Route::get('del-page/{id}','PageController@del');
			Route::post('list-page','PageController@delMulti');
		});

		Route::group(['namespace' => 'image'],function(){
			Route::get('list-image','ImageController@index');
			Route::post('list-image','ImageController@delMulti');
			Route::post('list-product-image','ImageController@delMulti');
			Route::get('list-product-image','ImageController@productImage');
			Route::get('add-image','ImageController@getAddImage');
			Route::post('add-image','ImageController@postAddImage');
			Route::get('edit-image/{id}','ImageController@getEditImage');
			Route::post('edit-image/{id}','ImageController@postEditImage');
			Route::get('del-image/{id}','ImageController@delImage');
			Route::get('add-product-image/{id?}','ImageController@getAddProductImage');
			Route::post('add-product-image/{id?}','ImageController@postAddProductImage');
		});

		Route::group(['namespace' => 'siteOption'],function(){
			Route::get('site-option','SiteOptionController@index');
			Route::post('site-option','SiteOptionController@post');
		});

		Route::group(['namespace' => 'menu'],function(){
			Route::get('list-menu','MenuController@index');
			Route::get('add-menu','MenuController@getadd');
			Route::post('add-menu','MenuController@postadd');
			Route::get('edit-menu/{id}','MenuController@getedit');
			Route::post('edit-menu/{id}','MenuController@postedit');
			Route::get('menu-position/{position}','MenuController@changePosition');
			Route::get('listmenu-position/{position}','MenuController@listchangePosition');
			Route::get('del-menu/{id}','MenuController@del');
			Route::post('list-menu','MenuController@delMulti');
		});

		Route::group(['namespace' => 'contact'],function(){
			Route::get('list-contact','ContactController@index');
			Route::post('list-contact','ContactController@delMulti');
			Route::get('del-contact/{id}','ContactController@del');
		});

		Route::group(['namespace' => 'module'],function(){
			Route::get('list-module','ModuleController@index');
			Route::get('add-module','ModuleController@getAdd');
			Route::post('add-module','ModuleController@postAdd');
			Route::get('del-module/{id}','ModuleController@del');
			Route::get('module/{table}','ModuleController@module_index');
			Route::get('module/{table}/add','ModuleController@getModuleAdd');
			Route::post('module/{table}/add','ModuleController@postModuleAdd');
			Route::get('module/{table}/edit/{id}','ModuleController@getModuleEdit');
			Route::post('module/{table}/edit/{id}','ModuleController@postModuleEdit');
			Route::get('module/{table}/del/{id}','ModuleController@moduleDel');
			Route::get('generateDB','ModuleController@generateDB');
		});

		Route::get('ajax/get-alias/{str}','AjaxController@getAlias');

		Route::get('ajax/recruit_cate_home/{id}','AjaxController@getEditRecruitmentCateHome');

		Route::get('ajax/recruitment_home/{id}','AjaxController@getEditRecruitmentHome');
		Route::get('ajax/recruitment_hot/{id}','AjaxController@getEditRecruitmentHot');
		Route::get('ajax/recruitment_focus/{id}','AjaxController@getEditRecruitmentFocus');
		Route::get('ajax/recruitment_sort/{id}/{num}','AjaxController@getEditRecruitmentSort');

		Route::get('ajax/news_cate_home/{id}','AjaxController@getEditNewsCateHome');
		Route::get('ajax/news_cate_hot/{id}','AjaxController@getEditNewsCateHot');
		Route::get('ajax/news_cate_focus/{id}','AjaxController@getEditNewsCateFocus');
		Route::get('ajax/news_cate_sort/{id}/{num}','AjaxController@getEditNewsCateSort');

		Route::get('ajax/news_publish/{id}','AjaxController@getEditNewsPublish');
		Route::get('ajax/news_home/{id}','AjaxController@getEditNewsHome');
		Route::get('ajax/news_hot/{id}','AjaxController@getEditNewsHot');
		Route::get('ajax/news_focus/{id}','AjaxController@getEditNewsFocus');
		Route::get('ajax/news_sort/{id}/{num}','AjaxController@getEditNewsSort');

		Route::get('ajax/product_cate_home/{id}','AjaxController@getEditProductCateHome');
		Route::get('ajax/product_cate_hot/{id}','AjaxController@getEditProductCateHot');
		Route::get('ajax/product_cate_focus/{id}','AjaxController@getEditProductCateFocus');
		Route::get('ajax/product_cate_sort/{id}/{num}','AjaxController@getEditProductCateSort');

		Route::get('ajax/product_home/{id}','AjaxController@getEditProductHome');
		Route::get('ajax/product_hot/{id}','AjaxController@getEditProductHot');
		Route::get('ajax/product_focus/{id}','AjaxController@getEditProductFocus');
		Route::get('ajax/product_new/{id}','AjaxController@getEditProductNew');
		Route::get('ajax/product_active/{id}','AjaxController@getEditProductActive');
		Route::get('ajax/product_sort/{id}/{num}','AjaxController@getEditProductSort');

		Route::get('ajax/page_home/{id}','AjaxController@getEditPageHome');
		Route::get('ajax/page_hot/{id}','AjaxController@getEditPageHot');
		Route::get('ajax/page_focus/{id}','AjaxController@getEditPageFocus');
		Route::get('ajax/page_sort/{id}/{num}','AjaxController@getEditPageSort');

		Route::post('ajax/showUploadImage','AjaxController@showUploadImage');

		Route::get('ajax/usercheck/{level}','AjaxController@userCheck');

		Route::post('ajax/postaddcate','AjaxController@postAddCate');
		Route::post('ajax/postaddprovider','AjaxController@postAddProvider');
		Route::post('ajax/postaddcountry','AjaxController@postAddCountry');

		Route::get('ajax/display_contact/{id}','AjaxController@displayContact');
		
		Route::get('ajax/list-news/{i}','AjaxController@listNewsLoadMore');

		Route::group(['namespace' => 'lang'],function(){
			Route::get('change-lang/{lang}','LanguageController@change');
		});

		Route::get('ajax/check-order/{id}/{status}','AjaxController@checkOrder');

		Route::group(['namespace' => 'statistic'],function(){
			Route::get('statistic-list','StatisticController@index');
			Route::get('statistic-date/{id}','StatisticController@date');
		});

		Route::post('ajax/menu-sort','AjaxController@sortMenu');

		Route::get('ajax/statistic-status','AjaxController@statisticStatusChange');

		Route::get('ajax/module-publish/{name}','AjaxController@modulePublish');

		Route::post('ajax/maintenance-change','AjaxController@maintenanceChange');
		
	});

	Route::get('download-img','download/DownloadImageController@index');
});

// end admin

// if($detect->isMobile()){
//     Route::group(['namespace' => 'm_frontend'],function(){
//     	Route::get('/',function(){
//     		echo "mobile";
//     	});
//     	Route::get('{duong_dan}','MobileController@getpost');
//     });
// }else{
Route::group(['namespace' => 'frontend'],function(){
	Route::group(['namespace' => 'tag'],function(){
		Route::get('tag/{alias}','TagController@index');
	});

	Route::group(['namespace' => 'contact'],function(){
		Route::get('contact','ContactController@index');
		Route::get('lien-he.html','ContactController@index');
		Route::post('contact','ContactController@post');
		Route::post('lien-he.html','ContactController@post');
	});

	Route::group(['namespace' => 'shoppingcart'],function(){
		Route::get('shopping-cart','ShoppingCartController@index');
		Route::post('shopping-cart','ShoppingCartController@payment');
		Route::get('cart-destroy','ShoppingCartController@destroy');
		Route::get('cart-remove/{rowid}','ShoppingCartController@remove');
	});

	Route::group(['namespace' => 'ajax'],function(){
		Route::group(['prefix' => 'ajax'],function(){
			Route::get('addcart/{id}','AjaxController@addCart');
			Route::get('update-cart/{rowId}/{num}','AjaxController@updateCart');
			Route::get('remove-cart/{rowId}','AjaxController@removeCart');
			Route::get('search/{str}','AjaxController@searchProduct');
			Route::get('product-cate/{i}/{cate_id}','AjaxController@loadMoreProductCate');
		});
	});

	Route::group(['namespace' => 'checkdomain'],function(){
		Route::get('domain','WhoisController@index');
		Route::get('check-domain','WhoisController@check');
	});

	Route::group(['namespace' => 'search'],function(){
		Route::get('search-news','SearchController@searchNews');
	});

	Route::group(['namespace' => 'home'],function(){
		Route::get('/','HomeController@index');
		Route::get('{alias}.html','HomeController@getAlias');
	});

	Route::group(['namespace' => 'search'],function(){
		Route::get('search-product','SearchController@searchProduct');
	});

});
Route::group(['namespace' => 'facebook'],function(){
	Route::get('facebook-login','FacebookController@getLogin');
	Route::get('facebook-callback','FacebookController@callback');
});



