@extends('frontend.layout.layout')
@section('title') {!!$product->title_seo!!} @stop
@section('url') {{url($product->alias)}}.html @stop
@section('description') {!!$product->description_seo!!} @stop
@section('keywords') {!!$product->keyword_seo!!} @stop
@section('content')
<main>
	<section id="home">
		<div class="container">
			<div class="cate_breadcrumb col-md-12 col-xs-12">
				<a href="{{domain}}">Trang chủ</a> <i class="fa fa-angle-right"></i>
				@if(isset($cate_root)) <a href="{{url($cate_root->alias)}}.html">{{$cate_root->name}}</a> <i class="fa fa-angle-right"></i> @endif
				<a href="{{url($cate_current->alias)}}.html">{{$cate_current->name}}</a> <i class="fa fa-angle-right"></i>
				<a href="{{url($product->alias)}}.html"><strong>{{$product->name}}</strong></a>
			</div>
			@include('frontend.sidebar.left')
			<div class="col-md-9 col-xs-12">
				<div id="product_detail">
					<div class="img col-md-6">
						<img src="{{url($product->image)}}" class="img-thumbnail">
					</div>
					<div class="content col-md-6">
						<h3>{{$product->name}}</h3>
						<div class="info">{!!$product->info!!}</div>
						<div class="price"><span class="price_sale">Giá: @if($product->price_sale == 0) Liên hệ @else {{Helper::adddotstring($product->price_sale)}} đ @endif</span> @if($product->price != 0) <span class="price_old">{{Helper::adddotstring($product->price)}} đ</span> @endif</div>
						<div class="buy"><a href="javascript:void(0)" class="addcart" data-id="{{$product->id}}"><img src="{{url('public/frontend/images/btn-mua.jpg')}}"></a></div>
					</div>
				</div>
				<div class="clear"></div>
				<div id="product_content" class="col-md-12 col-xs-12">
					<h2>Giới thiệu sản phẩm</h2>
					<div class="content">{!! $product->content !!}</div>
				</div>
				<div class="product">
					<div class="col-md-12 col-xs-12">
						<h2>Sản phẩm liên quan</h2>
						<div class="line" style="margin-bottom: 20px;"></div>
					</div>
					<?php $i = 0; ?>
					@foreach($similar_product as $items)
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
				</div>
			</div>
		</div>
	</section>
</main>

<script type="text/javascript">
	$(window).scroll(function() {
		aaa = $(window).scrollTop() + $(window).height();
		console.log(aaa);
		if($(window).scrollTop() + $(window).height() == $(document).height()) {
			count = $(".m_item").length;
			url = '{{url("ajax/product-cate/")}}/'+count+'/{{$cate_current->id}}';
			// console.log(count);
			$.ajax({
				url:url,
				type:'get',
				cache:false,
				data:{'count':count,'cate_id':'{{$cate_current->id}}'},
				success:function(result){
					$("#product_list").html(result);
				}
			});
		}
	});
</script>
@stop