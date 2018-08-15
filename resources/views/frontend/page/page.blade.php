@extends('frontend.layout.layout')
@section('title') {!!$page->title_seo!!} @stop
@section('url') {{url($page->alias)}}.html @stop
@section('description') {!!$page->description_seo!!} @stop
@section('keywords') {!!$page->keyword_seo!!} @stop
@section('content')

<main>
	<section id="home">
		<div class="container">
			<div class="cate_breadcrumb col-md-12 col-xs-12">
				<a href="{{domain}}">Trang chủ</a> <i class="fa fa-angle-right"></i>
				<a href="{{url($page->alias)}}.html"><strong>{{$page->title}}</strong></a>
			</div>
			@include('frontend.sidebar.left')
			<div id="page_content" class="col-md-9 col-xs-12">
					<h2>{{$page->title}}</h2>
					<div class="line"></div>
					<div class="content">{!! $page->content !!}</div>
				</div>
			</div>
			</div>
		</div>
	</section>
</main>

@stop