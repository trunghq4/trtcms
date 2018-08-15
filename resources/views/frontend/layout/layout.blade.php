<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="keywords" content="@yield('keywords')"/>
	<meta name="description" content="@yield('description')"/>
	<meta property="og:url" content="@yield('url')" />
	<meta property="og:title" content="@yield('title')" />
	<meta property="og:type" content="website" />
	<meta property="og:description" content="@yield('description')" />
	<meta property="og:image" content="" />
	<link rel="icon" href="{{url($site_option->favicon)}}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="{{url('public/bootstrap/css')}}/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="{{url('public/bootstrap/css')}}/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="{{url('public/frontend/css/style.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="{{url('public/font-awesome')}}/css/font-awesome.min.css">
	<script src="{{url('public/jquery/jquery-3.2.1.min.js')}}"></script>
</head>
<body>
	<div id="cart_success">
		<div class="container">
			<div class="col-md-12">Sản phẩm đả được thêm vào giỏ hàng!</div>
		</div>
	</div>
	<div id="count-cart-bg">
		<div id="count_cart"><span>{{Cart::count()}}</span></div>
		<h3>
			<a href="{{url('shopping-cart')}}"><i class="fa fa-shopping-cart"></i></a>
		</h3>
	</div>
	@include('frontend.header.header')
	@yield('content')
	@include('frontend.footer.footer')
</body>
<!-- ajax mua hàng -->
<script type="text/javascript">
	$(document).ready(function(){
		$('.addcart').click(function(){
			id = $(this).attr('data-id');
			_token = $('input[name="_token"]').val();
			url = '{{url("ajax/addcart")}}/'+id;
			$.ajax({
				url:url,
				type:'get',
				cache:false,
				data:{'id':id,'_token':_token},
				success:function(result){
					$('#count_cart span').text(result);
					$('#cart_success').fadeIn();
					$('#cart_success').fadeOut(3000);
				}
			})
		})
		$('input[name="search_ajax"]').keyup(function(){
			str = $(this).val();
			url = '{{url("ajax/search")}}/'+str;
			$.ajax({
				url:url,
				cache:false,
				type:'get',
				data:{'str':str},
				success:function(result){
					$('#search_result').html(result);
				}
			})
		})
		$('input[name="search_ajax"]').focusout(function(){
			$('#search_result').html('');
		})
		$('.left_item .hover .readmore a').click(function(){
			target = $(this).attr('data-target');
			$(target).fadeIn(1000);
		});
		$('.quick_view .close').click(function(){
			$('.quick_view').fadeOut(1000);
		})
	})
	$(document).ready(function(){
		$('#menu ul li').mouseenter(function(){
			$(this).find('ul').slideDown(200);
		})
		$('#menu ul li').mouseleave(function(){
			$(this).find('ul').slideUp(200);
		})
	})
	$(document).ready(function() {
		$('#to_top').click(function(){
			$("html, body").animate({ scrollTop: 0 }, "slow");
		})
	})
	$('li.menu_parent').click(function(){
		ddown = $(this).attr('data-child');
		$(ddown).slideToggle();
	})
	$('#collapse a.menu-link').click(function(e){
		e.preventDefault();
		var posClick = $(this).attr('href');
		var pos = $(posClick).position().top;
		$("[href='"+posClick+"']").addClass("current");
		$('html, body').animate({
			scrollTop:pos+20
		},1000);
	});
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="{{url('public/bootstrap')}}/js/bootstrap.min.js"></script>
</html>
