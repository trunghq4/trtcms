@extends('admin.layout.layout')
@section('title')
Thêm Danh mục
@stop
@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
            <span class="section">Thêm danh mục</span>
            @include('errors.note')
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tên danh mục<span class="required">*</span> </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="position" class="form-control col-md-7 col-xs-12 input" data-validate-length-range="6" data-validate-words="2" name="position"  required="required" type="text" value="{{old('position')}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Đường dẫn </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="alias" class="form-control col-md-7 col-xs-12 output" name="alias" type="text" value="{{old('alias')}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Hiển thị </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <p style="padding: 5px;">
                  <input type="checkbox" name="hot" value="hot" class="flat" @if(old('hot') != "") checked @endif/>
                  Hot <br />
                <p>
              </div>
            </div>
            <div class="clear"></div>
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
@stop
