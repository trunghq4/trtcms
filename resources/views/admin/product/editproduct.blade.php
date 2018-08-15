@extends('admin.layout.layout')
@section('title') Sửa Sản phẩm
@stop
@section('content')

<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
      @include('errors.note')
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="post" enctype='multipart/form-data'>
            <span class="section">Sửa Sản phẩm</span>
            <div class="col-md-9">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tên sản phẩm<span class="required">*</span> </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12 input" name="name"  required="required" type="text" value="{{$get_old->name}}">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="submit" name="submit" class="btn btn-success pull-right" value="Sửa">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Đường dẫn </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="alias" class="form-control col-md-7 col-xs-12 output" name="alias" type="text" value="{{$get_old->alias}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Mã sản phẩm </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="code" class="form-control col-md-12 col-xs-12" name="code" type="text" value="{{$get_old->code}}">
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Giá cũ</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="price" class="form-control col-md-12 col-xs-12" name="price" type="number" value="{{$get_old->price}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Giá mới</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="price_sale" class="form-control col-md-12 col-xs-12" name="price_sale" type="number" value="{{$get_old->price_sale}}">
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="view_count">Lượt xem</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="view_count" class="form-control col-md-12 col-xs-12" name="view_count" type="number" value="{{$get_old->view_count}}">
                </div>
              </div>
              <div class="item form-group">
                <label for="image" class="control-label col-md-3">Ảnh mô tả</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
                </div>
                <div class="col-md-1 col-xs-12 col-sm-1 loading" style="display: none;"><img src="{{url('public/images/loading.gif')}}" style="width:100%;"></div>
                @if($get_old->thumb != "") <div class="col-md-1 col-sm-1 col-xs-12 show-img"><img src="{{url($get_old->thumb)}}" class="img-thumbnail"></div> @else <div class="col-md-1 col-sm-1 col-xs-12 show-img"></div> @endif
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3">Gắn watermark</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="checkbox" name="watermark" class="flat">
                </div>
              </div>
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Mô tả</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="description" id="description" class="form-control">{{$get_old->description}}</textarea>
                </div>
              </div>
              <div class="item form-group">
                <label for="info" class="control-label col-md-3">Thông số kĩ thuật</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="info" id="info" class="form-control">{{$get_old->info}}</textarea>
                </div>
              </div>
              <script type="text/javascript">CKEDITOR.replace('info')</script>
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="content" id="content" class="form-control">{{$get_old->content}}</textarea>
                </div>
              </div>
              <script type="text/javascript">CKEDITOR.replace('content')</script>
              <div class="item form-group">
                <label for="content" class="control-label col-md-3">Chính sách bảo hành</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="guarantee" id="guarantee" class="form-control">{{$get_old->guarantee}}</textarea>
                </div>
              </div>
              <script type="text/javascript">CKEDITOR.replace('guarantee')</script>
            </div>
            <div class="col-md-3">
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Hiển thị </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <p style="padding: 5px;">
                    <input type="checkbox" name="new" value="new" class="flat" @if($get_old->new == 1) checked @endif />
                    Mới <br />
                    <input type="checkbox" name="active" value="active" class="flat" @if($get_old->active == 1) checked @endif />
                    Active <br />
                    <input type="checkbox" name="hot" value="hot" class="flat" @if($get_old->hot == 1) checked @endif />
                    Hot <br />
                    <input type="checkbox" name="home" value="home" class="flat" @if($get_old->home == 1) checked @endif />
                    Trang chủ <br />
                    <input type="checkbox" name="focus" value="focus" class="flat" @if($get_old->focus == 1) checked @endif />
                    Nổi bật <br />
                  <p>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="">Size</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <select class="form-control col-md-12 col-xs-12" id="size" name="size">
                    <option @if($get_old->size == 0) selected @endif value="0">Chọn kích cỡ</option>
                    <option @if($get_old->size == 1) selected @endif value="1">S</option>
                    <option @if($get_old->size == 2) selected @endif value="2">M</option>
                    <option @if($get_old->size == 3) selected @endif value="3">L</option>
                    <option @if($get_old->size == 4) selected @endif value="4">XL</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;" for="category">Danh mục (Giữ phím ctrl để chọn nhiều danh mục) </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <select name="category_id[]" class="form-control" id="category_id" multiple>
                    <option value="1" @if(Helper::check_product_to_category($get_old->id,1)) selected @endif>Không có danh mục</option>
                    <?php foreach ($list_cate as $key => $value): ?>
                      <?php if ($value->parent_id == 0 && $value->id>1): ?>
                        <option name="category_id" value="{{$value->id}}" @if(Helper::check_product_to_category($get_old->id,$value->id)) selected @endif>
                      {{$value->name}}
                      </option>
                      {{Helper::sub_menu_pro($list_cate,$value->id,$get_old)}}
                      <?php endif ?>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-12 col-sm-12 col-xs-12"><a href="javascript:void(0)" class="toaddmore" data-id="#addcate"><i class="fa fa-plus"></i> Thêm danh mục</a></div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;" for="category">Hãng sản xuất </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <select name="provider_id" class="form-control" id="provider_id">
                    <option value="1">Chọn hãng sản xuất</option>
                    <?php foreach ($list_provider as $key => $value): ?>
                      @if($value->id > 1)
                        <option value="{{$value->id}}" @if($value->id == $get_old->provider_id) selected @endif class="form-control">
                      {{$value->name}}
                      </option>
                      @endif
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-12 col-sm-12 col-xs-12"><a href="javascript:void(0)" class="toaddmore" data-id="#addprovider"><i class="fa fa-plus"></i> Thêm Hãng sản xuất</a></div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;" for="category">Xuất sứ</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <select name="country_id" class="form-control" id="country_id">
                    <option value="1">Xuất sứ</option>
                    <?php foreach ($list_country as $key => $value): ?>
                      @if($value->id > 1)
                        <option value="{{$value->id}}" class="form-control" @if($get_old->country_id == $value->id) selected @endif>
                      {{$value->name}}
                      </option>
                      @endif
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <div class="col-md-12 col-sm-12 col-xs-12"><a href="javascript:void(0)" class="toaddmore" data-id="#addcountry"><i class="fa fa-plus"></i> Thêm Xuất sứ</a></div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="description_seo">Title Seo </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" id="title_seo" name="title_seo" class="form-control col-md-7 col-xs-12" value="{{$get_old->title_seo}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="description_seo">Description Seo </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" id="description_seo" name="description_seo" class="form-control col-md-7 col-xs-12" value="{{$get_old->description_seo}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="keyword_seo">Keyword Seo </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" id="keyword_seo" name="keyword_seo" class="form-control col-md-7 col-xs-12" value="{{$get_old->keyword_seo}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="tags">Tags </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input id="tags_1" type="text" name="tags" class="tags form-control col-md-7 col-xs-12" value="{{implode(',',json_decode($get_old->tags))}}" />
                  <div id="suggestions-container" style="position: relative; float: left; width: 100%; margin: 10px;"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="submit" name="submit" class="btn btn-success" value="Sửa">
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3 text-center">
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
<div id="addcate" class="addmore">
  <form action="" method="post" id="frm-addcate">
    <div class="form-group">
      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; color:#fff" for="name">Tên danh mục </label>
      <div class="col-xs-12 col-md-12 col-sm-12">
        <input type="text" name="name" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; color:#fff" for="name">Danh mục cha </label>
      <div class="col-xs-12 col-md-12 col-sm-12">
        <select name="parent_id" class="form-control">
          <option value="0">Chọn danh mục</option>
            @foreach($list_cate as $items)
            @if($items->parent_id == 0 && $items->id>1)
            <option value="{{$items->id}}" @if(old('parent_id') == $items->id) selected @endif>{{$items->name}}</option>
            {{Helper::sub_add_cate_pro($list_cate,$items->id)}}
            @endif
            @endforeach
        </select>
      </div>
      <div class="clear"></div>
      <div class="ln_solid"></div>

      <div class="form-group text-center">
        <div class="col-md-12 col-xs-12 col-sm-12">
          <input type="submit" name="addcate" class="btn btn-primary" value="Sửa">
        </div>
      </div>
    </div>
    {{csrf_field()}}
  </form>
</div>
<div id="addprovider" class="addmore">
  <form action="" method="post" id="frm-addprovider">
    <div class="form-group">
      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; color:#fff" for="name">Tên hãng Sản xuất</label>
      <div class="col-xs-12 col-md-12 col-sm-12">
        <input type="text" name="name" class="form-control">
      </div>
    </div>
      <div class="clear"></div>
      <div class="ln_solid"></div>
      <div class="form-group text-center">
        <div class="col-md-12 col-xs-12 col-sm-12">
          <input type="submit" name="addprovider" class="btn btn-primary" value="Thêm">
          <button type="button" class="btn btn-warning" name="cancel">Cancel</button>
        </div>
      </div>
      {{csrf_field()}}
  </form>
</div>
<div id="addcountry" class="addmore">
  <form action="" method="post" id="frm-addcountry">
    <div class="form-group">
      <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left; color:#fff" for="name">Xuất sứ</label>
      <div class="col-xs-12 col-md-12 col-sm-12">
        <input type="text" name="name" class="form-control">
      </div>
    </div>
      <div class="clear"></div>
      <div class="ln_solid"></div>
      <div class="form-group text-center">
        <div class="col-md-12 col-xs-12 col-sm-12">
          <input type="submit" name="addcountry" class="btn btn-primary" value="Thêm">
        </div>
      </div>
      {{csrf_field()}}
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.toaddmore').click(function(){
      id = $(this).attr('data-id');
      $(id).fadeIn(200);
    })
    $('button[name=cancel]').click(function(){
      $('.addmore').fadeOut(200);
    })

    $('input[name="addcate"]').click(function(e){
      e.preventDefault();
      data = $('form#frm-addcate').serialize();
      $.ajax({
        url:'{{domain}}/admin/ajax/postaddcate',
        cache:false,
        type:'post',
        data:data,
        success: function(result){
          if(result == 'error'){
            alert(result);
            $('.addmore').fadeOut(250);
          }else{
            $('#category_id').html(result);
            $('.addmore').fadeOut(250);
          }
        }
      });
    });
    $('input[name="addprovider"]').click(function(e){
      e.preventDefault();
      data = $('form#frm-addprovider').serialize();
      $.ajax({
        url:'{{domain}}/admin/ajax/postaddprovider',
        cache:false,
        type:'post',
        data:data,
        success: function(result){
          if(result == 'error'){
            alert(result);
            $('.addmore').fadeOut(250);
          }else{
            $('#provider_id').html(result);
            $('.addmore').fadeOut(250);
          }
        }
      })
    });
    $('input[name="addcountry"]').click(function(e){
      e.preventDefault();
      data = $('form#frm-addcountry').serialize();
      $.ajax({
        url:'{{domain}}/admin/ajax/postaddcountry',
        cache:false,
        type:'post',
        data:data,
        success: function(result){
          if(result == 'error'){
            alert(result);
            $('.addmore').fadeOut(250);
          }else{
            $('#country_id').html(result);
            $('.addmore').fadeOut(250);
          }
        }
      })
    });
  })
</script>
@stop