@extends('admin.layout.layout')
@section('title')
Sửa Ảnh
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
            <span class="section">Sửa Ảnh</span>
            @include('errors.note')
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tiêu đề</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" class="form-control col-md-7 col-xs-12 input" data-validate-length-range="6" data-validate-words="2" name="title" type="text" value="{{$get_old->title}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Vị trí </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="position" name="position" class="form-control">
                  <option value="banner" @if($get_old->position == 'banner') selected @endif>Banner</option>
                  <option value="slide" @if($get_old->position == 'slide') selected @endif>Slide</option>
                  <option value="partner" @if($get_old->position == 'partner') selected @endif>Đối tác</option>
                  <option value="gallery" @if($get_old->position == 'gallery') selected @endif>Thư viện ảnh</option>
                  @if($get_old->position == 'product') <option value="product" selected>Sản phẩm</option> @endif
                </select>
              </div>
            </div>
            <div class="clear"></div>
            @if($get_old->position == 'product')
            <div class="item form-group col-md-6" style="padding-left: 215px">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Sản phẩm</label>
               <div class=" col-md-6 col-sm-6 col-xs-12">
                 <input class="form-control" name="product_name" value="{{$product->name}}" disabled="" type="text">
                 <input type="hidden" name="id_product" value="{{$product->id}}">
               </div>
            </div>
            <div class="clear"></div>
            @endif
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Url </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="url" class="form-control col-md-7 col-xs-12 input" name="url" type="text" value="{{$get_old->url}}">
              </div>
            </div>
            @if($get_old->position == 'product')
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Chọn ảnh</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
                </div>
                <div class="clear"></div>
                @if(file_exists($get_old->thumb))<div class="col-md-1 col-sm-1 col-xs-12 show-img col-md-offset-3 col-sm-offset-3" id="image-holder"><img src="{{url($get_old->thumb)}}" class="img-thumbnail"></div> @else <div class="col-md-1 col-sm-1 col-xs-12 show-img col-md-offset-3 col-sm-offset-3"></div> @endif
              </div>
            @else
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">Chọn ảnh</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
              </div>
              <div class="col-md-1 col-xs-12 col-sm-1 loading" style="display: none;"><img src="{{url('public/images/loading.gif')}}" style="width:100%;"></div>
              @if(file_exists($get_old->thumb))<div class="col-md-1 col-sm-1 col-xs-12 show-img" id="image-holder"><img src="{{url($get_old->thumb)}}" class="img-thumbnail"></div> @else <div class="col-md-1 col-sm-1 col-xs-12 show-img" id="image-holder"></div> @endif
            </div>
            @endif
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">Mô tả</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="description" id="description" class="form-control">{{$get_old->description}}</textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <input id="submit" name="submit" type="submit" class="btn btn-success" value="Sửa" />
              </div>
            </div>
            {{csrf_field()}}
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
</script>
@stop
