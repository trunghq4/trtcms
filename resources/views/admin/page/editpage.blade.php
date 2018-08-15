@extends('admin.layout.layout')
@section('title') Sửa bài viết
@stop
@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel"> @include('errors.note')
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="post" enctype='multipart/form-data'>
            <span class="section">Thêm Tin Tức</span>
            <div class="col-md-9">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tiêu đề<span class="required">*</span> </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="title" class="form-control col-md-7 col-xs-12 input" name="title"  required="required" type="text" value="@if(!empty(old('title'))){{old('title')}}@else{{$get_old->title}}@endif">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Đường dẫn </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="alias" class="form-control col-md-7 col-xs-12 output" name="alias" type="text" value="@if(!empty(old('alias'))){{old('alias')}}@else{{$get_old->alias}}@endif">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Title Seo </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="title_seo" name="title_seo" class="form-control col-md-7 col-xs-12" value="@if(!empty(old('title_seo'))){{old('title_seo')}}@else{{$get_old->title_seo}}@endif">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Description Seo </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="description_seo" name="description_seo" class="form-control col-md-7 col-xs-12" value="@if(!empty(old('description_seo'))){{old('description_seo')}}@else{{$get_old->description_seo}}@endif">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword_seo">Keyword Seo </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="keyword_seo" name="keyword_seo" class="form-control col-md-7 col-xs-12" value="@if(!empty(old('keyword_seo'))){{old('keyword_seo')}}@else{{$get_old->keyword_seo}}@endif">
                </div>
              </div>
              <div class="item form-group">
                <label for="image" class="control-label col-md-3">Ảnh mô tả</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12 show-img" id="image-holder">
                  @if(file_exists($get_old->thumb)) <img src="{{url($get_old->thumb)}}" class="img-thumbnail"> @endif
                </div>
              </div>
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Mô tả</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="description" id="description" class="form-control">@if(!empty(old('description'))){{old('description')}}@else{{$get_old->description}} @endif</textarea>
                </div>
              </div>
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="content" id="content" class="form-control">@if(!empty(old('content'))){{old('content')}} @else{{$get_old->content}}@endif</textarea>
                </div>
              </div>
              <script type="text/javascript">CKEDITOR.replace('content')</script>
            </div>
            <div class="col-md-3">
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Hiển thị </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <p style="padding: 5px;">
                    <input type="checkbox" name="hot" value="hot" class="flat" @if($get_old->hot == 1) checked @endif/>
                    Hot <br />
                    <input type="checkbox" name="home" value="home" class="flat" @if($get_old->home == 1) checked @endif/>
                    Trang chủ <br />
                    <input type="checkbox" name="focus" value="focus" class="flat" @if($get_old->focus == 1) checked @endif/>
                    Nổi bật <br />
                  <p>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;" for="view_count">Số lượt truy cập </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="number" name="view_count" class="form-control" value="{{$get_old->view_count}}">
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <input id="submit" name="submit" type="submit" class="btn btn-success" value="Cập nhật" />
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