@extends('frontend.layout.layout')
@section('title') {!!$site_option->name!!} @stop
@section('url') {{domain}} @stop
@section('description') {!!$site_option->description_seo!!} @stop
@section('keyword') {!!$site_option->keyword_seo!!} @stop
@section('content')

<h1><i class="fa fa-check-square-o"></i></h1>
<main>
	<section id="slide">
		<div class="container">
			<div class="col-md-12 col-xs-12">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
					@foreach($slide as $key => $items)
						<li data-target="#myCarousel" data-slide-to="{{$key}}" @if($key == 0 ) class="active" @endif></li>
					@endforeach
					</ol>
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
					@foreach($slide as $key => $items)
						<div class="item @if($key == 0) active @endif">
							<a href="{{domain}}"><img src="{{url($items->link)}}" alt=""></a>
						</div>
					@endforeach
					</div>
					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</section>
	<section id="adv" class="hidden-xs">
		<div class="container">
			@foreach($banner as $items)
			<div class="col-md-4">
				<div class="item-img"><img src="{{url($items->link)}}"></div>
			</div>
			@endforeach
		</div>
	</section>
	<section id="search-product">
		<div class="container">
			<div class="col-md-12 col-xs-12">
				<div id="search-bar">
					<form action="{{url('search-product')}}">
						<div class="col-md-3 col-md-offset-1 col-xs-8">
							<input type="text" name="search_product" class="form-control" placeholder="Nhập tên sản phẩm">
						</div>
						<div class="col-md-3 hidden-xs">
							<select name="category_id" class="form-control">
								<option value="1">Chọn danh mục</option>
								<?php foreach ($list_cate as $key => $value): ?>
								<?php if ($value->parent_id == 0 && $value->id>1): ?>
									<option value="{{$value->id}}">
										{{$value->name}}
									</option>
								<?php endif ?>
								{{Helper::sub_menu_pro($list_cate,$value->id)}}
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-md-3 hidden-xs">
							<select name="price" class="form-control">
								<option value="0">Tìm kiếm theo giá</option>
								<option value="1 1000000">Dưới 1.000.000 đ </option>
								<option value="1000000 2000000">Từ 1.000.000 đến 2.000.000 đ</option>
								<option value="2000000 3000000">Từ 2.000.000 đến 3.000.000 đ</option>
								<option value="3000000 4000000">Từ 3.000.000 đến 4.000.000 đ</option>
								<option value="4000000 5000000">Từ 4.000.000 đến 5.000.000 đ</option>
								<option value="5000000 1">Trên 5.000.000 đ</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-4"><button type="submit" class="btn btn-warning">Tìm kiếm</button></div>
						{{csrf_field()}}
					</form>
				</div>
			</div>
		</div>
	</section>
	<section id="home">
		<div class="container">
			@include('frontend.sidebar.left')
			<div class="col-md-9 col-xs-12">
				<div id="cate_home">
					@foreach($cate_home as $cate)
					<div class="title col-md-12 col-xs-12">
						<h2><a href="{{url($cate->alias)}}.html">{{$cate->name}}</a></h2>
					</div>
					<div class="view_cate col-md-12 col-xs-12"><a href="{{url($cate->alias)}}.html">Xem Thêm <i class="fa fa-arrow-right"></i></a></div>
					<div class="slogan col-md-12 col-xs-12"><p>Misota sản xuất, cung cấp trọn gói nội thất văn phòng giá rẻ cho SME (SME:Small and medium enterprise - Doanh nghiệp vừa và nhỏ), với kho > 1200m2. <span style="color:red">Giao hàng chỉ 2 giờ</span> với hàng có sẵn. Với đơn hàng <span style="color:red">làm theo yêu cầu</span>, vui lòng liên hệ <strong>{{$site_option->hotline1}}</strong></p></div>
					<div class="clear"></div>
					<div class="col-md-12 col-xs-12">
						<div class="line"></div>
					</div>
					<div class="product">
						<?php $i = 0; ?>
						@foreach($all_pro as $items)
						@if($items->category_id == $cate->id)
						<?php $i++; ?>
						<div class="col-md-3 col-xs-12 left_item">
							<div class="img">
								<a href="{{url($items->alias)}}.html"><img src="{{url($items->image)}}"></a>
								<div class="hover"><div class="readmore"> <a data-target="#hv{{$items->id}}"><i class="fa fa-plus"></i> Xem nhanh</a></div></div>
							</div>
							<h3><a href="{{url($items->alias)}}.html">{{$items->name}}</a></h3>
							<div class="content">
								<div class="price">
									<div class="price_sale"><span style="color:#ff0000">@if($items->price_sale == 0) Liên hệ @else {{Helper::adddotstring($items->price_sale)}} đ @endif</span></div>
									@if($items->price != 0 )
									<div class="price_old"><span style="text-decoration: line-through;">{{Helper::adddotstring($items->price)}} đ</span></div>
									@endif
								</div>
								<div class="cart">
									<a href="javascript:void(0)" class="addcart" data-id="{{$items->id}}"><i class="fa fa-shopping-cart"></i></a>
								</div>
							</div>
						</div>
						<div id="hv{{$items->id}}" class="quick_view">
							<div class="items">
								<div class="img col-md-6">
									<img src="{{url($items->image)}}" class="img-thumbnail">
								</div>
								<div class="content col-md-6">
									<h3>{{$items->name}}</h3>
									<div class="info">{!!$items->info!!}</div>
									<div class="price"><span class="price_sale">Giá: @if($items->price_sale == 0) Liên hệ @else {{Helper::adddotstring($items->price_sale)}} đ @endif</span> @if($items->price != 0) <span class="price_old">{{Helper::adddotstring($items->price)}} đ</span> @endif</div>
									<div class="buy"><a href="javascript:void(0)" class="addcart" data-id="{{$items->id}}"><img src="{{url('public/frontend/images/btn-mua.jpg')}}"></a></div>
								</div>
							</div>
							<div class="close"><i class="fa fa-remove"></i></div>
						</div>
						@if($i%4 == 0) <div class="clear"></div> @endif
						<?php if($i%8 == 0){break;} ?>
						@endif
						@endforeach
					</div>
					@endforeach
				</div>
				<div class="banner_home col-md-12 hidden-xs">
					<img src="{{url('public/frontend/images/20850-4-20850.png')}}">
				</div>
				<div class="page_home col-md-7 col-xs-12 row">
					<div class="col-md-12 col-xs-12">
						<div class="line"></div>
					</div>
					@foreach($page_home as $items)
					<div class="items">
						<div class="col-md-3 col-xs-4 img">
							<a href="{{url($items->alias)}}.html"><img src="{{url($items->image)}}"></a>
						</div>
						<div class="col-md-9 col-xs-8 content">
							<h3><a href="{{url($items->alias)}}.html">{{$items->title}}</a></h3>
							<div class="description">{{$items->description}}</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="col-md-12 col-xs-12">
						<div class="line-orange"></div>
					</div>
					<div class="clear"></div>
					@endforeach
				</div>
				<div class="col-md-5 hidden-xs map pull-right">
					<div class="line"></div>
					<div style="margin-bottom: 15px;"></div>
				</div>
			</div>
		</div>
	</section>
</main>

@stop