@extends('admin.layout.layout')
@section('title') Danh sách thành viên @stop
@section('content')
<div class="">
  <div class="form-group">
    <a class="btn btn-success" href="{{url('admin/add-user')}}">Thêm thành viên</a>
    <input class="btn btn-danger" type="submit" name="delall" value="Xóa">
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Danh sách thành viên</h2>
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
          <p class="text-muted font-13 m-b-30"> @include('errors.note') </p>
          <table id="datatable" class="table table-bordered table-striped jambo_table bulk_action">
            <thead>
              <tr>
                <th> 
                  <th><input type="checkbox" id="check-all" class="flat"></th>
                </th>
                <th>Tên</th>
                <th>Account</th>
                <th>Chức vụ</th>
                <th>Avatar</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($all_user as $items)
            @if($items->id > 1)
              <tr>
                <td>
                  <th><input type="checkbox" id="check-all" class="flat"></th>
                </td>
                <td>{{$items->name}}</td>
                <td>{{$items->account}}</td>
                <td>@if($items->level == 1) Admin @elseif($items->level == 2) Editor @elseif($items->level == 3) Author @elseif($items->level == 4) Contributor @else Subcriber @endif</td>
                <td>@if($items->thumb != "") <img class="img-thumbnail" style="max-width: 150px" src="{{url($items->thumb)}}"> @endif</td>
                <td>{{$items->email}}</td>
                <td>{{$items->phone}}</td>
                <td>
                @if(Session::get('user')->user == 1 && $items->id != 1)
                  <a href="{{url('admin/edit-user/'.$items->id)}}" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                  <a href="{{url('admin/remove-user/'.$items->id)}}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                @endif
                </td>
              </tr>
            @endif
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop