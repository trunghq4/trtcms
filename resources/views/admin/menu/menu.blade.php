@extends('admin.layout.layout')
@section('title')
Danh sách menu
@stop
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('public/css/menu-manager.css')}}">

<form name="formbk" method="post">
<div class="">
  <div class="form-group">
    @if(Session::get('user')->menu == 1) <a class="btn btn-success" href="{{url('admin/add-menu')}}">Thêm Menu</a> @endif
    <!-- <button name="sortmenu" type="submit" class="btn btn-warning">Lưu vị trí</button> -->
    @if(Session::get('user')->menu == 1) <input class="btn btn-danger" type="submit" name="delall" value="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa!')"> @endif

    <textarea id="nestable-output" name="menuval" style="display: none;"></textarea>
  {{csrf_field()}}
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    @include('errors.note')
      <div class="x_panel">
        <div class="x_title">
          <h2>Danh sách Menu</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive">

            <div class="form-group">
              <label>Vị trí</label>
              <select id="position" class="form-control" style="width:200px; margin-bottom: 15px;">
                <option value="top" @if(Session::get('menu_position') == 'top') selected @endif class="form-control">top</option>
                <option value="left" @if(Session::get('menu_position') == 'left') selected @endif class="form-control">left</option>
                <option value="right" @if(Session::get('menu_position') == 'right') selected @endif class="form-control">right</option>
                <option value="bottom" @if(Session::get('menu_position') == 'bottom') selected @endif class="form-control">bottom</option>
              </select>
            </div>
            <div class="dd col-lg-8 col-xs-12 col-md-8 col-sm-12 col-md-offset-2 col-lg-offset-2" id="nestable">
              <ol class="dd-list">
                @foreach($menu as $items)
                @if($items->parent_id == 0)
                <li class="dd-item" data-id="{{$items->id}}">
                  <div class="dd-handle alert alert-info">
                    {{$items->name}} 
                  </div>
                  <div class="menu_action">
                    <a href="{{url('admin/edit-menu/'.$items->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="{{url('admin/del-menu/'.$items->id)}}" onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                  </div>
                  <ol class="dd-list">
                    {{Helper::admin_menu_sub($menu,$items->id)}}
                  </ol>
                </li>
                @endif
                @endforeach
              </ol>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{csrf_field()}}
</form>
<script type="text/javascript">
  $(document).ready(function(){
    $('#position').change(function(){
      val = $(this).val();
      url = '{{domain}}/admin/listmenu-position/'+val;
      window.location.href = url;
    });

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));

    $('#nestable').change(function(){
      val = $('#nestable-output').val();
      _token = $('input[name="_token"]').val();
      console.log(val);
      url = '{{url("admin/ajax/menu-sort")}}';
      $.ajax({
        url:url,
        type:"post",
        data:{"menuval":val,'_token':_token},
        cache:false,
        success:function(result){
          console.log(result);
        }
      });
    })

});
</script>
@stop