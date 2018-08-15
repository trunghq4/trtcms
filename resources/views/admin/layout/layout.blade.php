<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>

  <!-- Bootstrap -->
  <link href="{{url('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{url('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{url('public/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{url('public/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  <!-- Switchery -->
  <link href="{{url('public')}}/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="{{url('public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{url('public/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="{{url('public/admin/css/style.css')}}">
  <!-- bootstrap-daterangepicker -->
  <link href="{{url('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
  <!-- Custom Theme Style -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <link href="{{url('public/build/css/custom.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{url('public/css/style.css')}}">
  <!-- Datatables -->
  <link href="{{url('public')}}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{url('public')}}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="{{url('public')}}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="{{url('public')}}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="{{url('public')}}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <script src="{{url('public/ckeditor/ckeditor.js')}}"></script>
  <script src="{{url('public/ckfinder/ckfinder.js')}}"></script>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('admin')}}" class="site_title"><i class="fa fa-paw"></i> <span>TRTCMS</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
            <!-- <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div> -->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
                  @if(Session::get('user')->user == 1 && $module[0]->publish == 1) <li><a href="{{url('admin/list-user')}}"><i class="fa fa-edit"></i> Thành viên</a></li> @endif
                  @if(Session::get('user')->news == 1 && $module[1]->publish == 1)
                  <li><a><i class="fa fa-desktop"></i> Tin tức <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @if(Session::get('user')->add_news == 1) <li><a href="{{url('admin/add-news')}}">Thêm bài viết</a></li> @endif
                      @if(Session::get('user')->news_cate == 1) <li><a href="{{url('admin/list-news-category')}}">Danh mục bài viết</a></li> @endif
                      <li><a href="{{url('admin/list-news')}}">Danh sách bài viết</a></li>
                    </ul>
                  </li>
                  @endif
                  @if(Session::get('user')->product == 1 && $module[2]->publish == 1)
                  <li><a><i class="fa fa-table"></i> Sản phẩm <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @if(Session::get('user')->add_product == 1) <li><a href="{{url('admin/add-product')}}">Thêm sản phẩm</a></li> @endif
                      <li><a href="{{url('admin/list-product')}}">Danh sách sản phẩm</a></li>
                      @if(Session::get('user')->product_cate == 1)
                      <li><a href="{{url('admin/list-cate-product')}}">Danh mục sản phẩm</a></li>
                      <li><a href="{{url('admin/list-provider-product')}}">Hãng sản phẩm</a></li>
                      <li><a href="{{url('admin/list-country-product')}}">Xuất sứ</a></li>
                      @endif
                      @if(Session::get('user')->order == 1) <li><a href="{{url('admin/list-order')}}">Danh sách đặt hàng <span class="badge bg-red">{{$count_order}}</span></a></li> @endif
                    </ul>
                  </li>
                  @endif
                  @if(Session::get('user')->page == 1 && $module[3]->publish == 1)
                  <li><a><i class="fa fa-list-alt" aria-hidden="true"></i>Trang nội dung <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('admin/add-page')}}">Thêm trang nội dung</a></li>
                      <li><a href="{{url('admin/list-page')}}">Danh sách trang</a></li>
                    </ul>
                  </li>
                  @endif
                  @if(Session::get('user')->news == 1 && $module[4]->publish == 1)
                  <li><a><i class="fa fa-users" aria-hidden="true"></i> Tuyển dụng <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @if(Session::get('user')->add_news == 1) <li><a href="{{url('admin/add-recruitment')}}">Đăng tin tuyển dụng</a></li> @endif
                      @if(Session::get('user')->news_cate == 1) <li><a href="{{url('admin/list-recruitment-category')}}">Danh mục Tuyển dụng</a></li> @endif
                      <li><a href="{{url('admin/list-recruitment')}}">Danh sách Tuyển dụng</a></li>
                    </ul>
                  </li>
                  @endif
                  @if(Session::get('user')->gallery == 1 && $module[5]->publish == 1) <li><a href="{{url('admin/list-image')}}"><i class="fa fa-image"></i> Quản lý ảnh</a></li> @endif
                   @if($module[6]->publish == 1) <li><a href="{{url('admin/list-contact')}}"><i class="fa fa-bar-chart-o"></i>Liên hệ</a></li> @endif
                  @if(Session::get('user')->menu == 1 && $module[7]->publish == 1) <li><a href="{{url('admin/list-menu')}}"><i class="fa fa-clone"></i>Quản lý menu</a></li> @endif
                  @if(Session::get('user')->site_option == 1 && $module[8]->publish == 1) <li><a href="{{url('admin/site-option')}}"><i class="fa fa-wrench"></i>Cấu hình hệ thống</a></li> @endif
                  @if($module[9]->publish == 1) <li><a href="{{url('admin/statistic-list')}}"><i class="fa fa-book" aria-hidden="true"></i>Thống kê truy cập</a></li>  @endif

                  @if(Session::get('user')->module == 1)
                  <li><a><i class="fa fa-cog" aria-hidden="true"></i>Quản lý Module <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('admin/add-module')}}">Thêm module</a></li>
                      <li><a href="{{url('admin/list-module')}}">Danh sách Module</a></li>
                    </ul>
                  </li>
                  @endif
                  @if($module != "")
                  @foreach($module as $items)
                  @if($items->id > 10 && $items->publish == 1)
                  <li><a href="{{url('admin/module/'.$items->table_name)}}"><i class="fa fa-share"></i>{{$items->name}}</a></li>
                  @endif
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Add new module" href="{{url('admin/add-module')}}">
                <span class="fa fa-plus" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('admin/logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{Session::get('user')->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{url('admin/change-password')}}">@if(Session::get('lang') == 'vi') Đổi mật khẩu @elseif(Session::get('lang') == 'en') Change Password @endif</a></li>
                    <li><a href="{{url('admin/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <li>
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Session::get('lang') == 'vi')Ngôn ngữ @else Language @endif
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{url('admin/change-lang/vi')}}">Tiếng Việt</a></li>
                    <li><a href="{{url('admin/change-lang/en')}}">English</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown"></li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">


          @yield('content')


        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            TRTCMS - Gentelella Template
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{url('public/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{url('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{url('public/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{url('public/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{url('public/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{url('public/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{url('public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{url('public/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{url('public/vendors/skycons/skycons.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('public')}}/vendors/moment/min/moment.min.js"></script>
    <script src="{{url('public')}}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{url('public')}}/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Flot -->
    <script src="{{url('public/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{url('public/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{url('public/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{url('public/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{url('public/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{url('public/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{url('public/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{url('public/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{url('public/vendors/DateJS/build/date.js')}}"></script>
    <!-- Switchery -->
    <script src="{{url('public')}}/vendors/switchery/dist/switchery.min.js"></script>
    <!-- JQVMap -->
    <script src="{{url('public/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{url('public/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{url('public/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{url('public')}}/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Datatables -->
    <script src="{{url('public')}}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{url('public')}}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{url('public')}}/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{url('public')}}/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{url('public')}}/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{url('public/build/js/custom.min.js')}}"></script>
    <script src="{{url('public/js/jquery.form.min.js')}}"></script>
    <script src="{{url('public/js/jquery.nestable.js')}}"></script>
    <script src="{{url('public/admin/js/script.js')}}"></script>
    @yield('js')

  </body>
  <script type="text/javascript">
    $('.input').change(function(){
      url = "{{url('admin/ajax/get-alias')}}/";
      str = $(this).val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,'-');
      _token = $('input[name="_token"]').val();
      $.ajax({
        url: url+str,
        type: 'GET',
        cache:false,
        data:{'_token':_token,'str':str},
        success:function(data){
          $('.output').val(data);
        }
      });
    })

    $('input[name="checkAll"]').click(function(){
      if($('.check_del').is(':checked')){
        $('.check_del').prop('checked',false);
      }else{
        $('.check_del').prop('checked',true);
      }
    })
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#image').change(function(){
        $('.loading').show();
        url = '{{domain}}admin/ajax/showUploadImage';
        $.ajax({
        url: url, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData($('form')[0]), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data){
          $('.loading').hide();
          $('.show-img').html(data);
        }  // A function to be called if request succeeds
      });
      });
    })


