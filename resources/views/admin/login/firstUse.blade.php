<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TRTCMS!</title>

    <!-- Bootstrap -->
    <link href="{{domain}}/public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{domain}}/public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{domain}}/public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{domain}}/public/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{domain}}/public/build/css/custom.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  </head>
<style type="text/css">
  .login_content h1:before,.login_content h1:after{
    background: transparent;
  }
</style>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <h1>New manager account</h1>
              @include('errors.note')
              <div>
                <input type="text" name="name" class="form-control" placeholder="Name" required="" value="{{old('name')}}" />
              </div>
              <div>
                <input type="text" name="email" class="form-control" placeholder="Email" required="" value="{{old('email')}}" />
              </div>
              <div>
                <input type="text" name="account" class="form-control" placeholder="Account" required=""  value="{{old('account')}}"/>
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="password" name="re_password" class="form-control" placeholder="Password retype" required="" />
              </div>
              <div>
                <input class="btn btn-default submit" type="submit" name="submit" value="Login">
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i>  TRTCMS - Gentelella Template</h1>
                </div>
              </div>
              {{csrf_field()}}
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
