@extends('admin.layout.layout')
@section('title') Thư viện ảnh Sản phẩm @stop
@section('content')

<form name="formbk" method="post" action="">
<div class="">
	<div class="form-group">
		<a class="btn btn-success" href="{{url('admin/list-image')}}">Thư viện Ảnh</a>
		<input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')">
	</div>
	<div class="clearfix"></div>
    @include('errors.note')

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Thư viện ảnh</small></h2>
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
								<th><input type="checkbox" name="checkAll" class="flat" id="check-all"></th>
								<th style="width:3%">Stt</th>
								<th>Sắp xếp</th>
								<th>Tiêu đề</th>
								<th>Ảnh </th>
								<th>Vị trí</th>
								<th>Tên sản phẩm</th>
								<!-- <th>Hiển thị</th> -->
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
						@foreach($list_img as $items)
							<tr>
								<th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
								<td>{{$items->id}}</td>
								<td><input style="width:50px;" type="text" name="sort" id_product="{{$items->id}}" value="{{$items->sort}}"></td>
								<td>{{$items->title}}</td>
								<td><img style="width:100px" class="img-thumbnail" src="{{url($items->thumb)}}"></td>
								<td>{{$items->position}}</td>
								<td>@if($items->id_product > 0) {{$items->pro_name}} @endif</td>
								<td>
									<a href="{{url('admin/edit-image/'.$items->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
									<a href="{{url('admin/del-image/'.$items->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a>
								</td>
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
@stop