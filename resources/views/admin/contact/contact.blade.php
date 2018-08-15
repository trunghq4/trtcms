@extends('admin.layout.layout')
@section('title')
Danh sách Liên hệ
@stop
@section('content')
<form name="formbk" method="post" action="">
<div class="">
  <div class="form-group">
    @if(Session::get('user')->user == 1)<input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('errors.note')
      <div class="x_panel">
        <div class="x_title">
          <h2>Danh sách Liên hệ</h2>
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
            <table id="datatable" class="table table-striped table-bordered bulk_action">
              <thead>
                <tr>
                  <th><input type="checkbox" name="checkAll" id="check-all"></th>
                  <th style="width:3%">Stt</th>
                  <th>Họ và tên</th>
                  <th>Email</th>
                  <th>Điện thoại</th>
                  <th>Hiển thị</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($list_contact as $items)
                <tr>
                  <th><input type="checkbox" class="check_del" name="check_del[]" value="{{$items->id}}"></th>
                  <td>{{$items->id}}</td>
                  <td><a href="javascript:void(0)" class="view_detail" data-target=".c{{$items->id}}"><strong>{{$items->name}}</strong></a></td>
                  <td>{{$items->email}}</td>
                  <td>{{$items->phone}}</td>
                  <td><div class="form-group">
                      <input type="checkbox" class="check_display" id_contact="{{$items->id}}" name="display" @if($items->display == 1) checked @endif title="Hiển thị">
                    </div></td>
                  <td><a class="btn btn-warning btn-xs" onclick="return confirm('Bạn chắc chắn muốn xóa!')" href="{{url('admin/del-contact')}}/{{$items->id}}"><i class="fa fa-remove"></i></a></td>
                </tr>
                <tr class="c{{$items->id}} details" style="display: none;">
                  <th colspan="2">Địa chỉ</th>
                  <th colspan="2">Ghi chú</th>
                  <th colspan="2">Ngày đăng</th>
                  <th>Đóng</th>
                </tr>
                <tr class="c{{$items->id}} details" style="display: none;border-bottom: 2px solid #000">
                  <td colspan="2">{{$items->address}}</td>
                  <td colspan="2">{{$items->note}}</td>
                  <td colspan="2">{{date('d-m-Y'),$items->time}}</td>
                  <td><a href="javascript:void(0)" class="detail_close btn btn-danger btn-xs"><i class="fa fa-remove"></i></a></td>
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
    $('.view_detail').click(function(){
      target = $(this).attr('data-target');
      $(target).fadeIn();
    })
    $('.detail_close').click(function(){
      $('.details').fadeOut(200);
    })
    $('input[name="display"]').click(function(){
      id = $(this).attr('id_contact');
      url = '{{url("admin/ajax/display_contact")}}/'+id;
      _token = $('input[name="_token"').val();
      $.ajax({
        url:url,
        type:'GET',
        cache:false,
        data:{'id':id,'_token':_token},
        success:function(result){
        }
      });
    })
  })
</script>
@stop