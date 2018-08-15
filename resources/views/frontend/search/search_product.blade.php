@extends('frontend.layout.layout')
@section('title') Tìm kiếm @stop
@section('content')
<main>
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
			<div class="cate_breadcrumb col-md-12 col-xs-12">
				<a href="{{domain}}">Trang chủ</a> <i class="fa fa-angle-right"></i> <strong>Kết quả tìm kiếm</strong>
			</div>
			@include('frontend.sidebar.left')
			<div class="col-md-9 col-xs-12">
				<div id="cate_current">
					<div class="title col-md-12 col-xs-12">
						<h2><a href="javascript:void(0)">Kết quả tìm kiếm</a></h2>
					</div>
					<div class="clear"></div>
					<div class="product">
						<?php $i = 0; ?>
						@if(count($product) > 0)
						@foreach($product as $items)
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
						@endforeach
						@endif
						
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
@stop