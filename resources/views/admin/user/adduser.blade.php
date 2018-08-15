@extends('admin.layout.layout')
@section('title')
Thêm Thành viên
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
            <span class="section">Thêm Thành viên</span>
            @include('errors.note')
            <div class="col-md-8 col-xs-12">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Họ và tên </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" name="name" type="text">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alias">Tài khoản <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input id="account" class="form-control col-md-7 col-xs-12" name="account" required type="text">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Email<span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12" required>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description_seo">Điện thoại</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="phone" name="phone" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Địa chỉ</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" id="address" name="address" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Quyền quản trị</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select id="level" name="level" class="form-control">
                    @if(Session('user')->level < 2)<option value="1">Administrator</option> @endif
                    <option value="2">Editor</option>
                    <option value="3">Author</option>
                    <option value="4">Contributor</option>
                    <option value="5">Subcriber</option>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Mật khẩu <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" required>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="re_password">Nhập lại mật khẩu <span class="required">*</span></label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="password" id="re-password" name="re_password" class="form-control col-md-7 col-xs-12" required>
                </div>
              </div>
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Ảnh Đại diện</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                </div>
                <div class="col-md-1 col-xs-12 col-sm-1 loading" style="display: none;"><img src="{{url('public/images/loading.gif')}}" style="width:100%;"></div>
                <div class="col-md-2 col-md-offset-3 col-sm-2 col-sm-offset-3 col-xs-12 show-img"></div>
              </div>
            </div>
            @if(Session::get('user')->level == 1)
            <div class="col-md-4 col-xs-12">
              <div class="item">
                <h3>Phân quyền</h3>
              </div>
              <div class="item form-group">
                <label class="control-label">Quản lý thành viên</label>
                <input type="checkbox" id="user" name="user" class="" checked>
              </div>
              <div class="item form-group">
                <label class="control-label"><h4>Quản lý tin tức</h4></label><br>
                <label class="control-label">Xem danh sách tin</label>
                <input type="checkbox" id="news" name="news" class="" checked>
                <label class="control-label">Thêm tin mới</label>
                <input type="checkbox" id="add_news" name="add_news" class="" checked>
                <label class="control-label">Chỉnh sửa tin</label>
                <input type="checkbox" id="edit_news" name="edit_news" class="" checked><br>

                <label class="control-label">Xem danh mục tin</label>
                <input type="checkbox" id="news_cate" name="news_cate" class="" checked>
                <label class="control-label">Thêm danh mục</label>
                <input type="checkbox" id="add_news_cate" name="add_news_cate" class="" checked>
                <label class="control-label">Sửa danh mục</label>
                <input type="checkbox" id="edit_news_cate" name="edit_news_cate" class="" checked><br>
              </div>
              <div class="item form-group">
                <label class="control-label"><h4>Quản lý sản phẩm</h4></label><br>
                <label class="control-label">List sản phẩm</label>
                <input type="checkbox" id="product" name="product" class="" checked>
                <label class="control-label">Thêm sản phẩm</label>
                <input type="checkbox" id="add_product" name="add_product" class="" checked>
                <label class="control-label">Chỉnh sản phẩm</label>
                <input type="checkbox" id="edit_product" name="edit_product" class="" checked><br>

                <label class="control-label">Xem danh mục </label>
                <input type="checkbox" id="product_cate" name="product_cate" class="" checked>
                <label class="control-label">Thêm danh mục</label>
                <input type="checkbox" id="add_product_cate" name="add_product_cate" class="" checked>
                <label class="control-label">Sửa danh mục</label>
                <input type="checkbox" id="edit_product_cate" name="edit_product_cate" class="" checked><br>

                <label class="control-label">Xem Danh sách đặt hàng </label>
                <input type="checkbox" id="order" name="order" class="" checked>
              </div>
              <div class="item form-group">
                <label class="control-label">Quản lý Trang nội dung</label>
                <input type="checkbox" id="page" name="page" class="" checked>
              </div>
              <div class="item form-group">
                <label class="control-label">Quản lý Banner/Ảnh</label>
                <input type="checkbox" id="gallery" name="gallery" class="" checked>
              </div>
              <div class="item form-group">
                <label class="control-label">Quản lý Menu</label>
                <input type="checkbox" id="menu" name="menu" class="" checked>
              </div>
              <div class="item form-group">
                <label class="control-label">Cấu hình hệ thống</label>
                <input type="checkbox" id="site_option" name="site_option" class="" checked>
              </div>
              <div class="item form-group">
                <label class="control-label">Quản lý module</label>
                <input type="checkbox" id="module" name="module" class="" >
              </div>

            </div>
            @endif
            </div>
            <div class="clearfix"></div>
            <div class="ln_solid"></div>
            <div class="form-group text-center">
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
@if(Session::get('user')->level == 1)
<script type="text/javascript">
  $(document).ready(function(){
    $('#level').change(function(){
      url = '{{domain}}admin/ajax/usercheck/';
      level = $(this).val();
      _token = $('input[name="_token"]').val();
      $.ajax({
        url:url+level,
        type:'Get',
        cache:false,
        data:{'level':level,'_token':_token},
        success: function(data){
          obj = JSON.parse(data);
          if(obj.user == 1){
            document.getElementById('user').checked = true;
          }else{
            document.getElementById('user').checked = false;
          }
          if(obj.news == 1){
            document.getElementById('news').checked = true;
          }else{
            document.getElementById('news').checked = false;
          }
          if(obj.news_cate == 1){
            document.getElementById('news_cate').checked = true;
          }else{
            document.getElementById('news_cate').checked = false;
          }
          if(obj.add_news == 1){
            document.getElementById('add_news').checked = true;
          }else{
            document.getElementById('add_news').checked = false;
          }
          if(obj.add_news_cate == 1){
            document.getElementById('add_news_cate').checked = true;
          }else{
            document.getElementById('add_news_cate').checked = false;
          }
          if(obj.edit_news == 1){
            document.getElementById('edit_news').checked = true;
          }else{
            document.getElementById('edit_news').checked = false;
          }
          if(obj.edit_news_cate == 1){
            document.getElementById('edit_news_cate').checked = true;
          }else{
            document.getElementById('edit_news_cate').checked = false;
          }
          if(obj.product == 1){
            document.getElementById('product').checked = true;
          }else{
            document.getElementById('product').checked = false;
          }
          if(obj.product_cate == 1){
            document.getElementById('product_cate').checked = true;
          }else{
            document.getElementById('product_cate').checked = false;
          }
          if(obj.add_product == 1){
            document.getElementById('add_product').checked = true;
          }else{
            document.getElementById('add_product').checked = false;
          }
          if(obj.add_product_cate == 1){
            document.getElementById('add_product_cate').checked = true;
          }else{
            document.getElementById('add_product_cate').checked = false;
          }
          if(obj.edit_product == 1){
            document.getElementById('edit_product').checked = true;
          }else{
            document.getElementById('edit_product').checked = false;
          }
          if(obj.edit_product_cate == 1){
            document.getElementById('edit_product_cate').checked = true;
          }else{
            document.getElementById('edit_product_cate').checked = false;
          }
          if(obj.gallery == 1){
            document.getElementById('gallery').checked = true;
          }else{
            document.getElementById('gallery').checked = false;
          }
          if(obj.site_option == 1){
            document.getElementById('site_option').checked = true;
          }else{
            document.getElementById('site_option').checked = false;
          }
          if(obj.menu == 1){
            document.getElementById('menu').checked = true;
          }else{
            document.getElementById('menu').checked = false;
          }
          if(obj.order == 1){
            document.getElementById('order').checked = true;
          }else{
            document.getElementById('order').checked = false;
          }
          if(obj.page == 1){
            document.getElementById('page').checked = true;
          }else{
            document.getElementById('page').checked = false;
          }
        }
      });
    })
  })
</script>
@endif
@stop
