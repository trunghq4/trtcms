<header>
	<div id="top-bar">
		<div class="container">
			<div class="col-md-4" id="logo">
				<a href="{{domain}}"><img src="{{url(Helper::site_option()->logo)}}"></a>
			</div>
			<div class="col-md-8" id="search_ajax">
				<form>
					<input type="text" name="search_ajax" class="form-control" id="ip_search_ajax" placeholder="Nhập tên sản phẩm">
					<div style="position: relative;">
						<div id="search_result"></div>
					</div>
					{{csrf_field()}}
				</form>
			</div>
		</div>
	</div>
	<div id="menu">
		<div class="container">
			<nav class="col-md-12 col-xs-12 navbar navbar-default header-menu" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse collapse-li" id="collapse">
					<ul>
					<li><a href="{{domain}}"><i class="fa fa-home"></i></a></li>
					@foreach($menu_top as $items)
					<li><a href="@if($items->url == "") javascript:void(0) @else {{url($items->url)}}.html @endif">{{$items->name}}</a>
						@if(Helper::check_sub('menu',$items->id))
						<ul>
							@foreach($menu_child as $val)
							@if($val->parent_id == $items->id)
							<li><a href="{{$val->url}}.html">{{$val->name}}</a></li>
							@endif
							@endforeach
						</ul>
						@endif
					</li>
					@endforeach
				</ul>
			</div>
		</nav>
		</div>
	</div>
</header>
<script type="text/javascript">
</script>