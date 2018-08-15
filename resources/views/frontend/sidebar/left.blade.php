<div class="col-md-3" id="sidebar">
	<div id="menu-left">
		<ul>
			@foreach($menu_left as $items)
				<li @if(Helper::check_sub('menu',$items->id)) style="background-image:url({{url('public/frontend/images/arrow_bot.png')}})" data-child=".li{{$items->id}}" class="menu_parent" @endif><a href="{{$items->url}}.html">{{$items->name}}</a>
				</li>
				@if(Helper::check_sub('menu',$items->id))
				<ul class="menu_child li{{$items->id}}">
					@foreach($menu_child as $child)
					@if($child->parent_id == $items->id)
					<li><a href="{{url($child->url)}}.html">{{$child->name}}</a></li>
					@endif
					@endforeach
				</ul>
				@endif
			@endforeach
		</ul>
	</div>
	<div class="left_img">
		<a href=""><img src="{{url('public/frontend/images/giao-hang-2-tieng-1.gif')}}"></a>
	</div>
	<div class="left_img">
		<a href=""><img src="{{url('public/frontend/images/tuvan1.png')}}"></a>
	</div>
	<div class="left_img">
		<a href=""><img src="{{url('public/frontend/images/TIET-KIEM.gif')}}"></a>
	</div>
	<div class="left_img text-center" id="hot_product">
		<h2>Sản phẩm xem nhiều</h2>
		<?php $i=0; ?>
		@foreach($hot_product as $items)
		<?php $i++; ?>
		<div class="left_item">
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
		<div class="clear"></div>
		<?php if($i%4==0){break;} ?>
		@endforeach
	</div>
</div>
<script type="text/javascript">
</script>