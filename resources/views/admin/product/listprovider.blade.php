@extends('admin.layout.layout')
@section('title')
Hãng sản phẩm
@stop
@section('content')
<form name="formbk" method="post" action="">
<div class="">
  <div class="form-group">
    @if(Session::get('user')->add_product_cate == 1) <a class="btn btn-success" href="{{url('admin/add-provider-product')}}">Thêm hãng</a> @endif
    @if(Session::get('user')->edit_product_cate == 1) <input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('errors.note')
      <div class="x_panel">
        <div class="x_title">
          <h2>Hãng sản phẩm</small></h2>
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
                  <th>
                    <th><input type="checkbox" name="checkAll" class="flat" id="check-all"></th>
                  </th>
                  <th style="">Stt</th>
                  <th>Tiêu đề</th>
                  @if(Session::get('user')->edit_product_cate == 1) <th>Action</th> @endif
                </tr>
              </thead>
              <tbody>
              @foreach($list_provider as $items)
              @if($items->id > 1)
                <tr>
                  <td>
                  <th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
                    </td>
                  <td>{{$items->id}}</td>
                  <td><strong>{{$items->name}}</strong></td>
                  @if(Session::get('user')->edit_product_cate == 1) <td><a href="{{domain}}admin/edit-provider-product/{{$items->id}}" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a> <a href="{{domain}}admin/del-provider-product/{{$items->id}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a></td> @endif
                </tr>
              @endif
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