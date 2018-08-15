@extends('admin.layout.layout')
@section('title') Danh sách Sản phẩm @stop
@section('content')
<form name="formbk" method="post" action="">
<div class="">
  <div class="form-group">
    @if(Session::get('user')->order == 1) <input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif
  </div>
  <div class="clearfix"></div>
    @include('errors.note')

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Danh sách Sản phẩm</small></h2>
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
                  <th><input type="checkbox" name="checkAll" class="flat" id="check-all"></th>
                  <th style="width:3%">Stt</th>
                  <th>Họ và tên</th>
                  <th>Email</th>
                  <th>Điện thoại</th>
                  <th>Tổng tiền</th>
                  <th>Trạng thái</th>
                  <th>Người duyệt</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
              @foreach($list_order as $items)
                <tr>
                  <th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
                  <td>{{$items->id}}</td>
                  <td>{{$items->name}}</td>
                  <td>{{$items->email}}</td>
                  <td>{{$items->phone}}</td>
                  <td><span style="color:red">{{Helper::adddotstring($items->total_price)}} đ</span></td>
                  <td>
                    <select name="status" class="form-control" data-id="{{$items->id}}" @if($items->status == 2) disabled @endif style="background:@if($items->status == 1) #FFA500 @elseif($items->status == 2) #0B9444 @else #DA0000 @endif;color:#fff;font-weight:bold;">
                      <option value="1" @if($items->status == 1) selected @endif>Chưa duyệt</option>
                      <option value="2" @if($items->status == 2) selected @endif>Xong</option>
                      <option value="3" @if($items->status == 3) selected @endif>Hủy</option>
                    </select>
                  </td>
                  <td>@if($items->admin != "") {{$items->admin}} @endif</td>
                  <td><a href="javascript:void(0)" class="btn btn-success btn-xs list_show" data-target=".order{{$items->id}}"><i class="fa fa-plus"></i></a><a href="{{url('admin/del-order')}}/{{$items->id}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a></td>
                </tr>
                <tr class="list_content order{{$items->id}}" style="display: none;">
                  <th colspan="3"><strong>Ảnh sản phẩm</strong></th>
                  <th colspan="2"><strong>Tên sản phẩm</strong></th>
                  <th colspan="2"><strong>Giá</strong></th>
                  <th><strong>Số lượng</strong></th>
                  <th colspan="2"><strong>Tổng</strong></th>
                </tr>
                @foreach(json_decode($items->content) as $content)
                  <tr class="list_content order{{$items->id}}" style="display: none;">
                    <td colspan="3">@if(file_exists($content->options->image)) <img style="width:100px" src="{{url($content->options->image)}}" class="img-thumbnail"> @endif</td>
                    <td colspan="2">{{$content->name}}</td>
                    <td colspan="2">{{Helper::adddotstring($content->price)}}</td>
                    <td>{{$content->qty}}</td>
                    <td colspan="2"><span style="color:red"> {{Helper::adddotstring($content->price*$content->qty)}} </span></td>
                  </tr>
                @endforeach
                  <tr class="list_content order{{$items->id}}" style="display: none;border-bottom: 2px solid #169F85">
                    <td colspan="3"><strong>Địa chỉ nhận hàng</strong></td>
                    <td colspan="6">{{$items->address}}</td>
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
  $('.list_show').click(function(){
    target = $(this).attr('data-target');
    $(target).slideToggle();
  })
  $('select[name="status"]').change(function(){
    status = $(this).val();
    id = $(this).attr('data-id');
    _token = $('input[name="_token"]').val();
    url = '{{domain}}/admin/ajax/check-order/'+id+'/'+status;
    $.ajax({
      url:url,
      cache:false,
      type:'get',
      data:{'id':id,'status':status,'_token':_token},
      success:function(){
        alert('Đã duyệt');
        window.location.reload();
      }
    });
  })
</script>
@stop