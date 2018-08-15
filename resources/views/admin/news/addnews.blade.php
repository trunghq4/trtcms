@extends('admin.layout.layout')
@section('title') Thêm bài viết
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
                  <input id="title" class="form-control col-md-7 col-xs-12 input" data-validate-length-range="6" data-validate-words="2" name="title"  required="required" type="text" value="{{old('title')}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Đường dẫn </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="alias" class="form-control col-md-7 col-xs-12 output" name="alias" type="text" value="{{old('alias')}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Title Seo </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="title_seo" name="title_seo" class="form-control col-md-7 col-xs-12" value="{{old('title_seo')}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Description Seo </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="description_seo" name="description_seo" class="form-control col-md-7 col-xs-12" value="{{old('description_seo')}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keyword_seo">Keyword Seo </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="keyword_seo" name="keyword_seo" class="form-control col-md-7 col-xs-12" value="{{old('keyword_seo')}}">
                </div>
              </div>
              <div class="item form-group">
                <label for="image" class="control-label col-md-3">Ảnh mô tả</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
                </div>
                <div class="col-md-1 col-xs-12 col-sm-1 loading" style="display: none;"><img src="{{url('public/images/loading.gif')}}" style="width:100%;"></div>
                <div class="col-md-1 col-sm-1 col-xs-12 show-img" id="image-holder"></div>
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
                  <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                </div>
              </div>
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Nội dung</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="content" id="content" class="form-control">{{old('content')}}</textarea>
                </div>
              </div>
              <script type="text/javascript">CKEDITOR.replace('content')</script>
            </div>
            <div class="col-md-3">
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;">Xuất bản</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="checkbox" id="publish" name="publish" checked class="js-switch">
                </div>
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Hiển thị </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="checkbox" name="hot" value="hot" class="flat" @if(old('hot') != "") checked @endif/>
                    Hot <br />
                    <input type="checkbox" name="home" value="home" class="flat" @if(old('home') != "") checked @endif/>
                    Trang chủ <br />
                    <input type="checkbox" name="focus" value="focus" class="flat" @if(old('focus') != "") checked @endif/>
                    Nổi bật <br />
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;" for="view_count">Số lượt truy cập </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="number" name="view_count" class="form-control" value="{{old('view_count')}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;" for="category">Danh mục (Giữ phím ctrl để chọn nhiều danh mục) </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <select name="category_id[]" class="form-control" multiple id="category_id">
                    <option value="1" selected>Không có danh mục</option>
                    <?php foreach ($cate_news as $key => $value): ?>
                      <?php if ($value->parent_id == 0 && $value->id>1): ?>
                        <option value="{{$value->id}}" @if(old('category_id') == $value->id) selected @endif>
                        {{$value->title}}
                        </option>
                        {{Helper::sub_menu($cate_news,$value->id)}}
                      <?php endif ?>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="tags">Tags  </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input id="tags_1" type="text" name="tags" class="tags form-control col-md-7 col-xs-12" value="{{old('tags')}}" />
                  <div id="suggestions-container" style="position: relative; float: left; width: 100%; margin: 10px;"></div>
                </div>
                <div class="clear"></div>
              </div>
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
<div class="clearfix"></div>
@stop