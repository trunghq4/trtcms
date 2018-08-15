@extends('admin.layout.layout')
@section('title')
Thêm Module
@stop
@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
            </p>
            <span class="section">Thêm Module</span>
            @include('errors.note')
            <div class="form-group item">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên module<span class="required">*</span> </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="module_name" class="form-control col-md-7 col-xs-12" name="module_name"  required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên bảng<span class="required">*</span> </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="table_name" class="form-control col-md-7 col-xs-12" name="table_name"  required="required" type="text">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="column">Số cột</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="column" class="form-control col-md-7 col-xs-12" name="column" type="number" >
              </div>
            </div>
            <div id="column_list">
              
            </div>

            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <input id="submit" name="submit" type="submit" class="btn btn-success" value="Thêm" />
              </div>
            </div>
            {{csrf_field()}}
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{url('public/admin/js/module/module_add.js')}}"></script>
@stop
