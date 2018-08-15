@extends('admin.layout.layout')
@section('title')
Danh sách Module
@stop
@section('content')
<form name="formbk" method="post" action="">
<div class="">
  <div class="form-group">
    <a class="btn btn-success" href="{{url('admin/add-module')}}">Thêm Module</a>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('errors.note')
      <div class="x_panel">
        <div class="x_title">
          <h2>Danh sách Module</small></h2>
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
                  <th style="">Stt</th>
                  <th>Tên module</th>
                  <th>Tên bảng</th>
                  <th>Số cột</th>
                  <th>Hiển thị</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($list_module as $items)
              @if($items->id <= 10)
                <tr>
                  <td>{{$items->id}}</td>
                  <td>{{$items->name}}</td>
                  <td>{{$items->table_name}}</td>
                  <td></td>
                  <td><input type="checkbox" name="{{$items->table_name}}" @if($items->publish == 1) checked @endif></td>
                  <td></td>
                </tr>
              @else
                <tr>
                  <td>{{$items->id}}</td>
                  <td>{{$items->name}}</td>
                  <td>{{$items->table_name}}</td>
                  <td>{{$items->column}}</td>
                  <td><input type="checkbox" name="{{$items->table_name}}" @if($items->publish == 1) checked @endif></td>
                  <td><a href="javascript:void(0)" target=".d{{$items->id}}" class="btn btn-info btn-xs details"><i class="fa fa-plus" aria-hidden="true"></i></a> <a href="{{domain}}admin/del-module/{{$items->id}}" onclick="return confirm('Bạn chắc chắn muốn xóa!')" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                <thead class="d{{$items->id}}" style="display: none">
                  <tr>
                    <th>Cột</th>
                    <th>Tên cột</th>
                    <th>Tên hiển thị</th>
                    <th>Kiểu hiển thị</th>
                    <th>Kiểu dữ liệu</th>
                    <th>Độ dài</th>
                  </tr>
                </thead>
                <tbody class="d{{$items->id}}" style="display: none;border-bottom: 2px solid #000">
                  <?php $i=0; ?>
                  @foreach(json_decode($items->fields) as $field)
                  <?php $i++; ?>
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$field->name}}</td>
                    <td>{{$field->display_name}}</td>
                    <td>
                      @if($field->display_type == 0) Text 
                      @elseif($field->display_type == 1) Checkbox
                      @elseif($field->display_type == 2) Number
                      @elseif($field->display_type == 3) Radio
                      @elseif($field->display_type == 4) Select
                      @elseif($field->display_type == 5) File
                      @elseif($field->display_type == 6) Textarea
                      @endif

                    </td>
                    <td>
                      @if($field->type == 0 || $field->type == 3) Text 
                      @elseif($field->type == 1) Integer
                      @elseif($field->type == 2) Varchar
                      @elseif($field->type == 4) Date
                      @endif 
                    </td>
                    <td>{{$field->length}}</td>
                  </tr>
                  @endforeach
                </tbody>
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
<script type="text/javascript">
  $('.details').click(function(){
    target = $(this).attr('target');
    $(target).slideToggle();
    $(this).find('i').toggleClass('fa-plus');
    $(this).find('i').toggleClass('fa-times');
  })
  $(document).ready(function(){
    $('input[type=checkbox]').click(function(){
      name = $(this).attr('name');
      url = "{{url('admin/ajax/module-publish')}}/"+name;
      $.ajax({
        url:url,
        type:'get',
        cache:'false',
        data:{'name':name},
        success:function(data){
          console.log(data);
        }
      })
    })
  })
</script>
@stop