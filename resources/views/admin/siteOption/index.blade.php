@extends('admin.layout.layout')
@section('title') Cấu hính hệ thống
@stop
@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel"> @include('errors.note')
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="post" enctype='multipart/form-data'>
            <span class="section">Thêm</span>
            <div class="col-md-9" style="margin-top: 25px;">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Tên đơn vị<span class="required">*</span> </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12"  name="name" type="text" value="{{@$site_option->name}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Tên trang web </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="url" class="form-control col-md-7 col-xs-12" name="url" type="text" value="{{@$site_option->url}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Slogan</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="slogan" class="form-control col-md-12 col-xs-12" name="slogan" type="text" value="{{@$site_option->slogan}}">
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Description Seo</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="description_seo" class="form-control col-md-12 col-xs-12" name="description_seo" type="text" value="{{@$site_option->description_seo}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Keyword Seo</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="keyword_seo" class="form-control col-md-12 col-xs-12" name="keyword_seo" type="text" value="{{@$site_option->keyword_seo}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3">Địa chỉ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea name="address" id="address" class="form-control">{{@$site_option->address}}</textarea>
                </div>
              </div>
              <div class="item form-group">
                 <label class="control-label col-md-3">Bảo trì</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="checkbox" class="js-switch" name="maintenance" @if(Helper::site_option()->maintenance == 1) checked @endif data-switchery="true">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Logo</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file" name="image" id="fileUpload" class="form-control">
                </div>
                @if(isset($site_option->logo))
                <div class="col-md-12 col-sm-12 col-xs-12 show-img" id="image-holder">
                  <img  class="img-thumbnail" src="{{url($site_option->logo)}}">
                </div>
                @endif
              </div>
              <div class="clearfix"></div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Favicon</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file" id="fileUpload2" name="favicon" class="form-control">
                </div>
                @if(isset($site_option->favicon))
                <div class="col-md-12 col-sm-12 col-xs-12" id="image-holder2">
                  <img class="img-thumbnail"  src="{{url($site_option->favicon)}}">
                </div>
                @endif
              </div>
              <div class="clearfix"></div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Watermark</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file" id="fileUpload3" name="watermark" class="form-control">
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" id="image-holder3">
                  <img class="img-thumbnail"  src="{{url($site_option->watermark)}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Email</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" name="email" class="form-control" value="{{@$site_option->email}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Facebook</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" name="facebook" class="form-control" value="{{@$site_option->facebook}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Google +</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" name="google" class="form-control" value="{{@$site_option->google}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="skype">skype</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="text" name="skype" class="form-control" value="{{@$site_option->skype}}">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Hotline</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="hotline1" class="form-control" placeholder="hotline1" value="{{@$site_option->hotline1}}">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="hotline2" class="form-control" placeholder="hotline2" value="{{@$site_option->hotline2}}">
                </div>
                <div class="clear" style="margin-bottom: 10px;"></div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="hotline3" class="form-control" placeholder="hotline3" value="{{@$site_option->hotline3}}">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name="fax" class="form-control" placeholder="fax" value="{{@$site_option->fax}}">
                </div>
              </div>
              <div class="clear"></div>
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Cancel</button>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('input[name=maintenance]').change(function(){
      url = "{{url('admin/ajax/maintenance-change')}}"
      _token = $('input[name=_token]').val()
      $.ajax({
        url:url,
        cache:false,
        method:'post',
        data:{'_token':_token},
        success:function(data){
          console.log(data);
        }
      })
    })
  })
</script>
@stop