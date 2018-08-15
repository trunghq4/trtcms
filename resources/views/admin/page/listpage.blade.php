@extends('admin.layout.layout')
@section('title') Danh sách bài viết @stop
@section('content')

<form name="formbk" method="post" action="">
<div class="">
	<div class="form-group">
		@if(Session::get('user')->page == 1) <a class="btn btn-success" href="{{url('admin/add-page')}}">Thêm trang mới</a> @endif
		@if(Session::get('user')->page == 1) <input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif
	</div>
	<div class="clearfix"></div>
    @include('errors.note')

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Danh sách Tin tức</small></h2>
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
				<div class="x_content table-responsive">
						<table id="datatable" class="table table-bordered table-striped jambo_table bulk_action">
							<thead>
								<tr>
									<th>
										<th><input type="checkbox" name="checkAll" class="flat" id="check-all"></th>
									</th>
									<th style="width:3%">Stt</th>
									@if(Session::get('user')->page == 1) <th>Sắp xếp</th> @endif
									<th>Tiêu đề</th>
									<th>Ảnh bài viết</th>
									@if(Session::get('user')->page == 1)<th>Hiển thị</th> @endif
									<th>Ngày đăng</th>
									@if(Session::get('user')->page == 1) <th>Action</th> @endif
								</tr>
							</thead>

							<tbody>
							@foreach($list_page as $items)
								<tr>
									<td>
										<th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
									</td>
									<td>{{$items->id}}</td>
									@if(Session::get('user')->page == 1)<td><input style="width:50px;" type="text" id_page="{{$items->id}}" name="sort" value="{{$items->sort}}"></td> @endif
									<td>{{$items->title}}</td>
									<td><img style="width:100px" class="img-thumbnail" src="{{url($items->thumb)}}"></td>
									@if(Session::get('user')->page == 1)
									<td><div class="form-group">
										<label class="label-success col-md-10 col-xs-10 col-sm-10" style="color:#fff">Trang chủ</label>
										<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" name="home" id_page="{{$items->id}}" @if($items->home == 1) checked @endif title="Trang chủ"></div>
				                        <div class="clearfix"></div>
				                        <label class="label-primary col-md-10 col-xs-10 col-sm-10" style="color:#fff">Nổi bật</label>
										<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" name="hot" id_page="{{$items->id}}" title="Nổi bật" @if($items->hot == 1) checked @endif></div>
										<div class="clearfix"></div>
										<label class="label-warning col-md-10 col-xs-10 col-sm-10" style="color:#fff">Tiêu điểm</label>
										<div class="col-md-2 col-xs-2 col-sm-2"><input type="checkbox" name="focus" id_page="{{$items->id}}" title="Tiêu điểm" @if($items->focus == 1) checked @endif></div>
									</div></td>
									@endif
									<td>{{date('d-m-Y',$items->time+7*3600)}}</td>
									@if(Session::get('user')->page == 1) 
									<td>
										<a href="{{url('admin/edit-page/'.$items->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
										<a href="{{url('admin/del-page/'.$items->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a>
									</td>
									@endif
								</tr>
							@endforeach
							</tbody>
						</table>
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
			url = "{{url('admin/ajax/page_home')}}/";
			id = $(this).attr('id_page');
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
			url = "{{url('admin/ajax/page_hot')}}/";
			id = $(this).attr('id_page');
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
			url = "{{url('admin/ajax/page_focus')}}/";
			id = $(this).attr('id_page');
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
			url = "{{url('admin/ajax/page_sort')}}/";
			id = $(this).attr('id_page');
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
</script>
@stop