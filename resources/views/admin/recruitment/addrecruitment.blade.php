@extends('admin.layout.layout')
@section('title') Đăng tin tuyển dụng
@stop
@section('js')
  <script src="{{url('public/admin/js/recruitment/recruitment.js')}}"></script>
@stop
@section('content')
<div class="">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel"> @include('errors.note')
        <div class="x_content">
          <form class="form-horizontal form-label-left" method="post" enctype='multipart/form-data'>
            <span class="section">Đăng tin tuyển dụng</span>
            <div class="col-md-9">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Vị trí<span class="required">*</span> </label>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">Số lượng<span class="required">*</span> </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="quantity" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="quantity"  required="required" type="text" value="@if(old('quantity') != "" ) {{old('quantity')}} @else{{1}}@endif">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary">Mức lương<span class="required">*</span> </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="salary" name="salary" class="form-control">
                    <option value="0">Thỏa thuận</option>
                    <option value="1">Dưới 3 triệu</option>
                    <option value="2">3 - 5 triệu</option>
                    <option value="3">5 - 7 triệu</option>
                    <option value="4">7 - 10 triệu</option>
                    <option value="5">10 - 15 triệu</option>
                    <option value="6">Trên 15 triệu</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diploma">Yêu cầu bằng cấp<span class="required">*</span> </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="diploma" name="diploma" class="form-control">
                    <option value="0">Tất cả</option>
                    <option value="1">Trung học</option>
                    <option value="2">Trung cấp</option>
                    <option value="3">Cao đẳng</option>
                    <option value="4">Đại học</option>
                    <option value="5">Trên đại học</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="experience">Kinh nghiệm<span class="required">*</span> </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="experience" name="experience" class="form-control">
                    <option value="0">Tất cả</option>
                    <option value="1">Dưới 1 năm</option>
                    <option value="2">1 năm</option>
                    <option value="3">2 năm</option>
                    <option value="4">5 năm</option>
                    <option value="5">Trên 5 năm</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile">Yêu cầu hồ sơ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea id="profile" name="profile" class="form-control">{{old('profile')}}</textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Mô tả</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea id="description" name="description" class="form-control">{{old('description')}}</textarea>
                </div>
                <script type="text/javascript">CKEDITOR.replace('description')</script>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="benefit">Quyền lợi được hưởng</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea id="benefit" name="benefit" class="form-control">{{old('benefit')}}</textarea>
                <script type="text/javascript">CKEDITOR.replace('benefit')</script>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="requirement">Yêu cầu công việc</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <textarea id="requirement" name="requirement" class="form-control">{{old('requirement')}}</textarea>
                <script type="text/javascript">CKEDITOR.replace('requirement')</script>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="category">Hiển thị </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <p style="padding: 5px;">
                    <input type="checkbox" name="hot" value="hot" class="flat" @if(old('hot') != "") checked @endif/>
                    Hot <br />
                    <input type="checkbox" name="home" value="home" class="flat" @if(old('home') != "") checked @endif/>
                    Trang chủ <br />
                    <input type="checkbox" name="focus" value="focus" class="flat" @if(old('focus') != "") checked @endif/>
                    Nổi bật <br />
                  <p>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;" for="category">Danh mục </label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <select name="category_id" class="form-control">
                    <option value="1">Chọn danh mục</option>
                    <?php foreach ($cate_recruitment as $key => $value): ?>
                      <?php if ($value->id>1): ?>
                        <option name="category_id" value="{{$value->id}}" class="form-control" @if(old('category_id') == $value->id) selected @endif>
                      {{$value->position}}
                      </option>
                      <?php endif ?>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label for="image" class="control-label col-md-12" style="text-align: left">Ảnh mô tả</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="file" id="fileUpload" name="image" class="form-control col-md-7 col-xs-12">
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 loading" style="display: none;"><img src="{{url('public/images/loading.gif')}}" style="width:100%;"></div>
                <div class="col-md-4 col-sm-4 col-xs-12 show-img" id="image-holder"></div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: left;" for="time_out">Hạn nộp hồ sơ</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class='input-group date' id='myDatepicker4'>
                    <input type='text' id="time_out" name="time_out" class="form-control col-md-7 col-xs-12" readonly="readonly"  required value="{{old('time_out')}}"/>
                    <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                   </span>
                 </div>
                </div>
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
@stop
