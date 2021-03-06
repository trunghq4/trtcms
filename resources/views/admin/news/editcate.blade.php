@extends('admin.layout.layout')
@section('title')
Sửa Danh mục
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
            <span class="section">Thêm danh mục</span>
            @include('errors.note')
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tên danh mục<span class="required">*</span> </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="title" class="form-control col-md-7 col-xs-12 input" data-validate-length-range="6" data-validate-words="2" name="title"  required="required" type="text" value="{{$get_old->title}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Đường dẫn </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="alias" class="form-control col-md-7 col-xs-12 output" name="alias" type="text" value="{{$get_old->alias}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Title Seo </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="title_seo" name="title_seo" class="form-control col-md-7 col-xs-12" value="{{$get_old->title_seo}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Description Seo </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="description_seo" name="description_seo" class="form-control col-md-7 col-xs-12" value="{{$get_old->description_seo}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword_seo">Keyword Seo </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="keyword_seo" name="keyword_seo" class="form-control col-md-7 col-xs-12" value="{{$get_old->keyword_seo}}">
              </div>
            </div>
            <div class="item form-group col-md-6" style="padding-left: 215px;">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Danh mục cha </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="parent_id" name="parent_id" class="form-control">
                  <option value="0">Chọn danh mục</option>
                    @foreach($list_cate as $items)
                    @if($items->parent_id == 0 && $items->id>1)
                    <option value="{{$items->id}}" @if($get_old->parent_id == $items->id) selected @endif>{{$items->title}}</option>
                    {{Helper::sub_add_cate($list_cate,$items->id,$get_old->parent_id)}}
                    @endif
                    @endforeach
                </select>
              </div>
            </div>
            <div class="item form-group col-md-6">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Hiển thị </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <p style="padding: 5px;">
                  <input type="checkbox" name="hot" @if($get_old->hot == 1) checked @endif value="hot" data-parsley-mincheck="2" class="flat" />
                  Hot <br />
                  <input type="checkbox" name="home" @if($get_old->home == 1) checked @endif value="home" class="flat" />
                  Trang chủ <br />
                  <input type="checkbox" name="focus" @if($get_old->focus == 1) checked @endif value="focus" class="flat" />
                  Nổi bật <br />
                <p> 
              </div>
            </div>
            <div class="clear"></div>
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">Ảnh mô tả</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
              </div>
              <div class="col-md-1 col-xs-12 col-sm-1 loading" style="display: none;"><img src="{{url('public/images/loading.gif')}}" style="width:100%;"></div>
              @if($get_old->thumb !="")<div class="col-md-1 col-sm-1 col-xs-12 show-img" id="image-holder"><img src="{{url($get_old->thumb)}}" class="img-thumbnail"></div> @else <div class="col-md-1 col-sm-1 col-xs-12 show-img" id="image-holder"></div> @endif
            </div>
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">Mô tả</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="description" id="description" class="form-control">{{$get_old->description}}</textarea>
              </div>
            </div>
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
