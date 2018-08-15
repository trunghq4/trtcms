@extends('admin.layout.layout')
@section('title') Tìm kiếm bài viết @stop
@section('content')
<div class="x_content">
	<h2>Tìm kiếm</h2>
	<div class="form-group">
		<form action="{{url('admin/search-news')}}" method="POST">
			<div class="item form-group col-md-3 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="category_id" id="search_cate" class="form-control">
						<option value="1">Chọn danh mục</option>
						<?php foreach ($cate_news as $key => $value): ?>
							<?php if ($value->parent_id == 0 && $value->id>1): ?>
								<option name="category_id" value="{{$value->id}}" class="form-control">
									{{$value->title}}
								</option>
							<?php endif ?>
							{{Helper::sub_menu($cate_news,$value->id)}}
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="item form-group col-md-3 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="user_id" id="search_user" class="form-control">
						<option value="">Chọn thành viên</option>
						@foreach($list_user as $items)
						<option value="{{$items->id}}">{{$items->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="item form-group col-md-3 col-sm-12 col-xs-12">
				<div class="col-md-9 col-xs-12 col-sm-12">
				<input type="text" name="search_name" placeholder="Tên bài viết" class="form-control">
				</div>
				<div class="col-md-3 col-xs-12 col-sm-12">
					<button type="submit" name="submit_search" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</div>
			</div>
			{{csrf_field()}}
		</form>
	</div>
</div>
<form name="formbk" method="post" action="">
<div class="">
	<div class="form-group">
		@if(Session::get('user')->add_news == 1) <a class="btn btn-success" href="{{url('admin/add-news')}}">Thêm bài viết</a> @endif
		@if(Session::get('user')->edit_news == 1) <input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif
	</div>
	<div class="clearfix"></div>
    @include('errors.note')

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Kết quả tìm kiếm</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a>
								</li>
								<li><a href="#">Settings 2</a>
								</li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
						<table id="datatable" class="table table-bordered table-striped table-bordered bulk_action">
							<thead>
								<tr>
									<th>
										<th><input type="checkbox" class="flat" name="checkAll" id="check-all"></th>
									</th>
									<th style="width:3%">Stt</th>
									@if(Session::get('user')->edit_news == 1) <th>Sắp xếp</th> @endif
									<th>Tiêu đề</th>
									<th>Ảnh bài viết</th>
									<th>Danh mục</th>
									@if(Session::get('user')->edit_news == 1)<th>Hiển thị</th> @endif
									<th>Ngày đăng</th>
									@if(Session::get('user')->edit_news == 1) <th>Action</th> @endif
								</tr>
							</thead>

							<tbody id="list_news">
							@foreach($list_news as $items)
								<tr class="list_news">
									<td>
										<th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
									</td>
									<td>{{$items->id}}</td>
									@if(Session::get('user')->edit_news == 1)<td><input style="width:50px;" type="text" id_news="{{$items->id}}" name="sort" value="{{$items->sort}}"></td> @endif
									<td>{{$items->title}}</td>
									<td><img style="width:100px" class="img-thumbnail" src="{{url($items->thumb)}}"></td>
									<td>@if($items->category_id > 0) {{$items->cate_title}} @else Chưa có danh mục @endif</td>
									@if(Session::get('user')->edit_news == 1)
									<td><div class="form-group">
									<input type="checkbox" name="home" id_news="{{$items->id}}" @if($items->home == 1) checked @endif title="Trang chủ">
									<input type="checkbox" name="hot" id_news="{{$items->id}}" title="Hot" @if($items->hot == 1) checked @endif  style="margin-left: 15px">
									<input type="checkbox" name="focus" id_news="{{$items->id}}" title="Nổi bật" @if($items->focus == 1) checked @endif style="margin-left: 15px"></div></td>
									@endif
									<td>{{date('d-m-Y',$items->time+7*3600)}}</td>
									@if(Session::get('user')->edit_news == 1) 
									<td>
										<a href="{{url('admin/edit-news/'.$items->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
										<a href="{{url('admin/del-news/'.$items->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a>
									</td>
									@endif
								</tr>
							@endforeach
							</tbody>
						</table>
						<div class="text-center loading" style="display: none;">
							<img src="{{url('public/images/spinner.gif')}}" style="max-height: 80px;">
						</div>
						<script type="text/javascript">
							function DoCheck(status,FormName,from_)
							{
								var alen=eval('document.'+FormName+'.elements.length');
								alen=(alen>1)?eval('document.'+FormName+'.checkone.length'):0;
								if (alen>0)
								{
									for(var i=0;i<alen;i++)
										eval('document.'+FormName+'.checkone[i].checked=status');
								}
								else
								{
									eval('document.'+FormName+'.checkone.checked=status');
								}
								if(from_>0)
									eval('document.'+FormName+'.checkall.checked=status');
							}
						</script>
				</div>
			</div>
		</div>
	</div>
</div>
{{csrf_field()}}
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('input[name=home]').click(function(){
			url = "{{url('admin/ajax/news_home')}}/";
			id = $(this).attr('id_news');
			_token = $('input[name=_token]').val();
			$.ajax({
				url:url+id,
				type:'GET',
				cache:false,
				data:{'_token':_token,'id':id},
				success:function(data){
				}
			});
		});
		$('input[name=hot]').click(function(){
			url = "{{url('admin/ajax/news_hot')}}/";
			id = $(this).attr('id_news');
			_token = $('input[name=_token]').val();
			$.ajax({
				url:url+id,
				type:'GET',
				cache:false,
				data:{'_token':_token,'id':id},
				success:function(data){
				}
			});
		});
		$('input[name=focus]').click(function(){
			url = "{{url('admin/ajax/news_focus')}}/";
			id = $(this).attr('id_news');
			_token = $('input[name=_token]').val();
			$.ajax({
				url:url+id,
				type:'GET',
				cache:false,
				data:{'_token':_token,'id':id},
				success:function(data){
				}
			});
		});
		$('input[name=sort]').keyup(function(){
			url = "{{url('admin/ajax/news_sort')}}/";
			id = $(this).attr('id_news');
			num = $(this).val();
			_token = $('input[name=_token]').val();
			$.ajax({
				url:url+id+'/'+num,
				type:'GET',
				cache:false,
				data:{'_token':_token,'id':id,'num':num},
				success:function(data){
				}
			});
		});
	})
	$("#search_cate").change(function(){
		cate = $(this).val();
		url = "{{domain}}/admin/search-news-cate/"+cate;
		window.location.href = url;
		
	})
	$("#search_user").change(function(){
		id = $(this).val();
		url = "{{domain}}/admin/search-news-user/"+id;
		window.location.href = url;
	})
</script>
@stop