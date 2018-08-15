@extends('admin.layout.layout')
@section('title') Dashboard
@stop
@section('content')
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-newspaper-o"></i></div>
		<div class="count">{{$count_news}}</div>
		<div style="margin-top:10px;"></div>
		<h3><a href="{{url('admin/list-news')}}">Tin tức</a></h3>
	</div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-cubes"></i></div>
		<div class="count">{{$count_product}}</div>
		<div style="margin-top:10px;"></div>
		<h3><a href="{{url('admin/list-product')}}">Sản phẩm</a></h3>
	</div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-user"></i></div>
		<div class="count">{{$count_contact}}</div>
		<div style="margin-top:10px;"></div>
		<h3><a href="{{url('admin/list-contact')}}">Liên hệ</a></h3>
	</div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="tile-stats">
		<div class="icon"><i class="fa fa-shopping-cart"></i></div>
		<div class="count">{{$count_order}}</div>
		<div style="margin-top:10px;"></div>
		<h3><a href="{{url('admin/list-order')}}">Danh sách đặt hàng</a></h3>
	</div>
</div>
<div class="clear"></div>
@stop