@extends('admin.layout.layout')
@section('title')
{{$module_detail->name}}
@stop
@section('content')
<form name="formbk" method="post" action="">
<div class="">
  <div class="form-group">
    <a class="btn btn-success" href="{{url('admin/module/'.$module_detail->table_name.'/add')}}">Thêm</a>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('errors.note')
      <div class="x_panel">
        <div class="x_title">
          <h2>{{$module_detail->name}}</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a> </li>
                <li><a href="#">Settings 2</a> </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive">
            <table id="datatable" class="table table-bordered table-striped jambo_table bulk_action">
              <thead>
                <tr>
                  <th>Stt</th>
                  @foreach(json_decode($module_detail->fields) as $key => $items)
                  <th>{{$items->display_name}}</th>
                  @endforeach
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $key => $items)
                <tr>
                  @foreach($items as $value)
                  <td>@if(strpos($value,'upload') !== false)<img src="{{url($value)}}" class="img-thumbnail" style="max-width: 100px;">@else {!!$value!!}  @endif</td>
                  @endforeach
                  <td>
                    <a href="{{url('admin/module/'.$module_detail->table_name.'/edit/'.$items->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="{{url('admin/module/'.$module_detail->table_name.'/del/'.$items->id)}}" class="btn btn-xs btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?') "><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
{{csrf_field()}}
</form>
<script type="text/javascript">
  $('.details').click(function(){
    target = $(this).attr('target');
    $(target).slideToggle(1000);
  })
</script>
@stop