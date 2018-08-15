@extends('admin.layout.layout')
@section('title')
Danh mục tuyển dụng
@stop
@section('content')
<form name="formbk" method="post" action="">
<div class="">
  <div class="form-group">
    @if(Session::get('user')->add_news_cate == 1)<a class="btn btn-success" href="{{url('admin/add-cate-recruitment')}}">Thêm danh mục</a> @endif
    @if(Session::get('user')->edit_news_cate == 1)<input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('errors.note')
      <div class="x_panel">
        <div class="x_title">
          <h2>Danh mục tuyển dụng</small></h2>
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
                  <th><input type="checkbox" name="checkAll" class="flat" id="check-all"></th>
                  <th style="width:3%">Stt</th>
                  <th>Vị trí</th>
                  @if(Session::get('user')->edit_news_cate == 1) <th>Hiển thị</th> @endif
                  @if(Session::get('user')->edit_news_cate == 1) <th>Action</th> @endif
                </tr>
              </thead>
              <tbody>
              @foreach($list_cate as $items)
                <tr>
                  <th><input type="checkbox" class="check_del flat" name="check_del[]" value="{{$items->id}}"></th>
                  <td>{{$items->id}}</td>
                  <td>{{$items->position}}</td>
                  @if(Session::get('user')->edit_news_cate == 1)
                  <td><div class="form-group">
                      <input type="checkbox" class="recruit_cate_home" id_cate="{{$items->id}}" name="home" @if($items->hot == 1) checked @endif title="Tin hot">
                    </div></td>
                  <td><a href="{{domain}}admin/edit-cate-recruitment/{{$items->id}}" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a> <a href="{{domain}}admin/del-cate-recruitment/{{$items->id}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a></td>
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
<script type="text/javascript">

</script>
{{csrf_field()}}
</form>
<script type="text/javascript">
  $(document).ready(function(){
    $('.recruit_cate_home').click(function(){
      url = "{{url('admin/ajax/recruit_cate_home')}}/";
      id = $(this).attr('id_cate');
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
  });
</script>
@stop