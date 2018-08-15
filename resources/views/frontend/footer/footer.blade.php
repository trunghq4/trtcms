<div id="to_top" class="hidden-lg hidden-md">
	<i class="fa fa-angle-up"></i>
</div>
<footer>
	<div class="container">
	@foreach($menu_bot as $items)
		<div class="col-md-3 col-xs-12">
			<h3><a href="{{url($items->url)}}.html">{{$items->name}}</a></h3>
			@if(check_sub('menu',$items->id))
			<ul class="menu_bot">
			@foreach($menu_child as $child)
			@if($child->parent_id == $items->id)
				<li><a href="{{url($child->url)}}.html">{{$child->name}}</a></li>
			@endif
			@endforeach
			</ul>
			@endif
		</div>
	@endforeach
		<div class="col-md-3 col-xs-12 contact">
			<h3><a href="javascript:void(0)">Liên hệ</a></h3>
			<p>
				<span>{{$site_option->name}}</span><br>
				Địa chỉ: {{strip_tags($site_option->address)}} <br>
				Hotline: {{$site_option->hotline1}} <br>
				Email: {{$site_option->email}} 
			</p>
		</div>
	</div>
	<div class="clear"></div>
</footer>

<script type="text/javascript">
</script>