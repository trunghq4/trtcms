@extends('admin.layout.layout')
@section('title')
Thêm Menu
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
            <span class="section">Thêm Menu</span>
            @include('errors.note')
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Vị trí</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="position" name="position" class="form-control">
                    <option value="top" @if(Session::get('menu_position') == 'top') selected @endif>Menu Top</option>
                    <option value="left" @if(Session::get('menu_position') == 'left') selected @endif>Menu Left</option>
                    <option value="right" @if(Session::get('menu_position') == 'right') selected @endif>Menu Right</option>
                    <option value="bottom" @if(Session::get('menu_position') == 'bottom') selected @endif>Menu Bottom</option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tiêu đề<span class="required">*</span> </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" class="form-control col-md-7 col-xs-12" name="name" type="text" value="{{$get_old->name}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Url</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="url" class="form-control col-md-7 col-xs-12" name="url" type="text" value="{{$get_old->url}}">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Hiển thị</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="home" class="flat" name="home" type="checkbox" @if($get_old->home == 1) checked @endif>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Danh mục cha </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="parent_id" name="parent_id" class="form-control">
                  <option value="0">Chọn menu cha</option>
                    @foreach($menu as $items)
                    @if($items->parent_id == 0)
                    <option value="{{$items->id}}" @if($get_old->parent_id == $items->id) selected @endif>{{$items->name}}</option>
                    {{Helper::sub_add_menu($menu,$items->id,$get_old->parent_id)}}
                    @endif
                    @endforeach
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Module</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="module" name="module" class="form-control">
                  <option value="" @if($get_old->module == "") selected @endif>Chọn module</option>
                  <option value="news_cate" @if($get_old->module == "news_cate") selected @endif>Danh mục tin tức</option>
                  <option value="product_cate" @if($get_old->module == "product_cate") selected @endif>Danh mục sản phẩm</option>
                  <option value="page" @if($get_old->module == "page") selected @endif>Trang nội dung</option>
                </select>
              </div>
            </div>
            <div class="clear"></div>
            <div class="item form-group news_cate" @if($get_old->module != "news_cate") style="display: none;" @endif>
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục tin</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="news_cate" name="news_cate" class="form-control">
                  <option value="">Chọn danh mục</option>
                  <?php foreach ($list_newscate as $key => $value): ?>
                      <?php if ($value->parent_id == 0 && $value->id>1): ?>
                        <option name="category_id" value="{{$value->id}}" @if($get_old->news_cate == $value->id) selected @endif class="form-control">
                      {{$value->title}}
                      </option>
                      <?php endif ?>
                      {{Helper::sub_menu($list_newscate,$value->id,$get_old->news_cate)}}
                    <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="clear"></div>
            <div class="item form-group pro_cate" @if($get_old->module != "product_cate") style="display: none;" @endif>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Danh mục sản phẩm</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="product_cate" name="product_cate" class="form-control">
                  <option value="">Chọn danh mục</option>
                  <?php foreach ($list_procate as $key => $value): ?>
                      <?php if ($value->parent_id == 0 && $value->id>1): ?>
                        <option name="category_id" value="{{$value->id}}" @if($get_old->product_cate == $value->id) selected @endif  class="form-control">
                      {{$value->name}}
                      </option>
                      <?php endif ?>
                      {{Helper::sub_menu_pro($list_procate,$value->id,$get_old->product_cate)}}
                    <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="clear"></div>
            <div class="item form-group page" @if($get_old->module != "page") style="display: none;" @endif>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Trang nội dung</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="page" name="page" class="form-control">
                <option value="">Chọn Trang nội dung</option>
                  @foreach($pages as $items)
                    <option value="{{$items->id}}" @if($get_old->page == $items->id) selected @endif  class="form-control">{{$items->title}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="clear"></div>
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">Icon</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
              </div>
              <div class="col-md-1 col-sm-1 col-xs-12 show-img" id="image-holder">@if(file_exists($get_old->icon)) <img src="{{url($get_old->icon)}}" class="img-thumbnail"> @endif</div>
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
  $(document).ready(function(){
    $('#module').change(function(){
      val = $(this).val();
      if(val == 'news_cate'){
        $('.news_cate').show();
        $('.pro_cate').hide();
        $('.page').hide();
      }else if(val == 'product_cate'){
        $('.news_cate').hide();
        $('.pro_cate').show();
        $('.page').hide();
      }else if(val == 'page'){
        $('.news_cate').hide();
        $('.pro_cate').hide();
        $('.page').show();
      }else{
        $('.news_cate').hide();
        $('.pro_cate').hide();
        $('.page').hide();
      }
    })
    $('#position').change(function(){
      val = $(this).val();
      url = '{{domain}}/admin/menu-position/'+val;
      window.location.href = url;
    })
  })
</script>
@stop
