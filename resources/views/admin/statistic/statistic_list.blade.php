@extends('admin.layout.layout')
@section('title')
Thống kê truy cập
@stop
@section('content')
<form name="formbk" method="post" action="">
<div class="">
  <div class="form-group">
    @if(Session::get('user')->user == 1) <input class="btn btn-danger" type="submit" name="delall" value="Xóa"> @endif
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('errors.note')
      <div class="x_panel">
        <div class="x_title">
          <h2>Thống kê truy cập</small></h2>
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
        <div class="x_content">
          <div class="form-group">
            <label for="">Bật/Tắt:</label> <input type="checkbox" class="js-switch" name="statistic" @if(Helper::site_option()->statistic == 1) checked @endif data-switchery="true">
          </div>
            <table id="datatable" class="table table-bordered table-striped jambo_table bulk_action">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" class="flat" id="check-all"></th>
                  <th style="width:3%">Stt</th>
                  <th>Ngày truy cập</th>
                </tr>
              </thead>
              <tbody>
              @foreach($list_date as $items)
                <tr>
                  <th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
                  <td>{{$items->id}}</td>
                  <td><a href="{{url('admin/statistic-date')}}/{{$items->id}}"><strong style="color:blue;font-size: 16px;">{{json_decode($items->date)->day}}-{{json_decode($items->date)->month}}-{{json_decode($items->date)->year}}</strong></a></td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="text-center">{!!str_replace('/?','?',$list_date->render())!!}</div>
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
    $('input[name=statistic]').change(function(e){
      e.preventDefault();
      url = "{{url('admin/ajax/statistic-status')}}";
      $.ajax({
        url:url,
        cache:false,
        type:'get',
        success:function(data){
          alert('Update thành công');
        }        
      })
    })
  })
</script>
@stop