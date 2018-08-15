@extends('admin.layout.layout')
@section('title') Kết quả tìm kiếm @stop
@section('content')
<div class="x_content">
	<h2>Tìm kiếm</h2>
	<div class="form-group">
		<form action="{{url('admin/search-product')}}" method="GET">
			<div class="item form-group col-md-3 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="category_id" class="form-control">
						<option value="1">Chọn danh mục</option>
						<?php foreach ($list_cate as $key => $value): ?>
							<?php if ($value->parent_id == 0 && $value->id>1): ?>
								<option value="{{$value->id}}" class="form-control" @if(old('category_id') == $value->id) selected @endif>
									{{$value->name}}
								</option>
							<?php endif ?>
							{{Helper::sub_menu_pro($list_cate,$value->id)}}
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="item form-group col-md-3 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="provider_id" class="form-control" id="provider_id">
						<option value="1">Chọn hãng sản xuất</option>
						<?php foreach ($list_provider as $key => $value): ?>
							@if($value->id > 1)
							<option value="{{$value->id}}" class="form-control" @if(old('provider_id') == $value->id) selected @endif>
								{{$value->name}}
							</option>
							@endif
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="item form-group col-md-3 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<select name="country_id" class="form-control" id="country_id">
						<option value="1">Xuất sứ</option>
						<?php foreach ($list_country as $key => $value): ?>
							@if($value->id > 1)
							<option value="{{$value->id}}" class="form-control" @if(old('country_id') == $value->id) selected @endif>
								{{$value->name}}
							</option>
							@endif
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="item form-group col-md-3 col-sm-12 col-xs-12">
				<div class="col-md-9 col-xs-12 col-sm-12">
				<input type="text" name="search_name" placeholder="Tên sản phẩm" class="form-control">
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
		@if(Session::get('user')->add_product == 1) <a class="btn btn-success" href="{{url('admin/add-product')}}">Thêm Sản phẩm</a> @endif
		@if(Session::get('user')->edit_product == 1) <input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif
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
				<div class="clear"></div>

				<div class="clear"></div>
				<div class="x_content table-responsive">
						<table id="datatable" class="table table-bordered table-striped jambo_table bulk_action">
							<thead>
								<tr>
									<th>
										<th><input type="checkbox" name="checkAll" class="flat" id="check-all"></th>
									</th>
									<th style="width:3%">Stt</th>
									@if(Session::get('user')->edit_product == 1) <th>Sắp xếp</th>  @endif
									<th>Tiêu đề</th>
									<th>Ảnh bài viết</th>
									<th>Danh mục</th>
									<th>Hãng sản xuất</th>
									@if(Session::get('user')->edit_product == 1) <th>Hiển thị</th> @endif
									@if(Session::get('user')->edit_product == 1) <th>Action</th> @endif
								</tr>
							</thead>

							<tbody>
							@foreach($list_pro as $items)
								<tr>
									<td>
										<th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
									</td>
									<td>{{$items->id}}</td>
									@if(Session::get('user')->edit_product == 1) <td><input style="width:50px;" type="text" name="sort" id_product="{{$items->id}}" value="{{$items->sort}}"></td> @endif
									<td>{{$items->name}}</td>
									<td><img style="width:100px" class="img-thumbnail" src="@if(!file_exists($items->thumb)) {{url('public/images/noimg.jpg')}} @else {{url($items->thumb)}} @endif"></td>
									<td>@if($items->category_id > 0) {{$items->cate_name}} @else Chưa có danh mục @endif</td>
									<td>@if($items->provider_id > 0) {{$items->provider_name}} @else Chưa có hãng sản xuất @endif</td>
									@if(Session::get('user')->edit_product == 1) <td><div class="form-group">
									<label class="label-info col-md-10 col-xs-10 col-sm-10" style="color: #fff">Sp mới</label>
									<input type="checkbox" class="col-md-2 col-xs-2 col-sm-2" name="new" id_product="{{$items->id}}" @if($items->new == 1) checked @endif title="Sản phẩm mới">
									<div class="clearfix"></div>
									<label class="label-default col-md-10 col-xs-10 col-sm-10" style="color: #fff">Active</label>
									<input type="checkbox" class="col-md-2 col-xs-2 col-sm-2" name="active" id_product="{{$items->id}}" @if($items->active == 1) checked @endif title="Active">
									<div class="clearfix"></div>
									<label class="label-success col-md-10 col-xs-10 col-sm-10" style="color: #fff">Trang chủ</label>
									<input type="checkbox" class="col-md-2 col-xs-2 col-sm-2" name="home" id_product="{{$items->id}}" @if($items->home == 1) checked @endif title="Trang chủ">
									<div class="clearfix"></div>
									<label class="label-primary col-md-10 col-xs-10 col-sm-10" style="color: #fff">Nổi bật</label>
									<input type="checkbox" name="hot" class="col-md-2 col-xs-2 col-sm-2" id_product="{{$items->id}}" title="Nổi bật" @if($items->hot == 1) checked @endif>
									<div class="clearfix"></div>
									<label class="label-warning col-md-10 col-xs-10 col-sm-10" style="color: #fff">Tiêu điểm</label>
									<input type="checkbox" name="focus" class="col-md-2 col-xs-2 col-sm-2" id_product="{{$items->id}}" title="Tiêu điểm" @if($items->focus == 1) checked @endif></div></td> @endif
									@if(Session::get('user')->edit_product == 1) <td>
										<a href="{{url('admin/edit-product/'.$items->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
										<a href="{{url('admin/del-product/'.$items->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a>
										<a href="{{url('admin/add-product-image/'.$items->id)}}" title="Thêm ảnh sản phẩm" class="btn btn-success btn-xs"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
									</td> @endif
								</tr>
							@endforeach
							</tbody>
						</table>
						<div class="text-center">{!!str_replace('/?','?',$list_pro->render())!!}</div>
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
						<div class="text-center"></div>
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
      url = "{{url('admin/ajax/product_home')}}/";
      id = $(this).attr('id_product');
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
      url = "{{url('admin/ajax/product_hot')}}/";
      id = $(this).attr('id_product');
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
      url = "{{url('admin/ajax/product_focus')}}/";
      id = $(this).attr('id_product');
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
    $('input[name=new]').click(function(){
      url = "{{url('admin/ajax/product_new')}}/";
      id = $(this).attr('id_product');
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
    $('input[name=active]').click(function(){
      url = "{{url('admin/ajax/product_active')}}/";
      id = $(this).attr('id_product');
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
      url = "{{url('admin/ajax/product_sort')}}/";
      id = $(this).attr('id_product');
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
    $('select[name=category_id]').change(function(){
    	id = $(this).val();
    	url = "{{url('admin/search-product-cate')}}/"+id;
    	window.location.href = url;
    })
	$('#provider_id').change(function(){
		id = $(this).val();
		url = "{{url('admin/search-product-provider')}}/"+id;
		window.location.href = url;
	})
	$('#country_id').change(function(){
		id = $(this).val();
		url = "{{url('admin/search-product-country')}}/"+id;
		window.location.href = url;
	})
  })
</script>
@stop