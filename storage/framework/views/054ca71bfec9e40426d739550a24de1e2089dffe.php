<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Explore | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <script type="text/javascript" src="<?php echo e(URL::asset('AlertifyJS/build/alertify.js')); ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('AdminLTE/dist/css/AdminLTE.min.css')); ?>" />
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('AdminLTE/dist/css/blue.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(URL::asset('AlertifyJS/build/css/alertify.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(URL::asset('AlertifyJS/build/css/themes/default.rtl.css')); ?>" />

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">

<?php
  if(isset($value)){
      if($value == 'Sent'){
          echo "<script>";
          echo "alertify.alert('Explore','An email has been sent.');";
          echo "</script>";

          ?><div class="login-box">
            <div class="login-logo">
              <a href="../../index2.html"><b>EXPLORE </b>Inc.</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
              <p class="login-box-msg">Enter verfication code provided in email</p>

              <form method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group has-feedback">
                  <?php echo e(Form::text('code', null, array('placeholder'=>'Enter code here','class'=>'form-control'))); ?>

                  <span class="glyphicon glyphicon-refresh form-control-feedback"></span>
                </div>
                <div class="row">
                  <!-- /.col -->
                  <div class="col-xs-4">
                    <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
                    <?php echo e(Form::submit('Proceed',array('name'=>'proceed','class'=>'btn btn-primary btn-block btn-flat'))); ?>

                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                  Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                  Google+</a>
              </div>
              <!-- /.social-auth-links -->

            </div>
            <!-- /.login-box-body -->
          </div>
          <!-- /.login-box --><?php

      } else if($value == 'Correct Code'){
          // reset password form

          ?><div class="login-box">
              <div class="login-logo">
                <a href="../../index2.html"><b>EXPLORE </b>Inc.</a>
              </div>
              <!-- /.login-logo -->
              <div class="login-box-body">
                <p class="login-box-msg">Please provide new password</p>

                <form method="post">
                  <?php echo e(csrf_field()); ?>

                  <div class="form-group has-feedback">
                    <?php echo e(Form::password('password', array('placeholder'=>'Password','class'=>'form-control'))); ?>

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <?php echo e(Form::password('rpassword', array('placeholder'=>'Repeat Password','class'=>'form-control'))); ?>

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
                      <?php echo e(Form::submit('Reset',array('name'=>'change_password','class'=>'btn btn-primary btn-block btn-flat'))); ?>

                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
                </div>
                <!-- /.social-auth-links -->

              </div>
              <!-- /.login-box-body -->
            </div>
            <!-- /.login-box --><?php

      } else if($value == 'Wrong Code'){
          echo "<script>";
          echo "alertify.alert('Explore','Verfication code is incorrect');";
          echo "</script>";
          ?><div class="login-box">
            <div class="login-logo">
              <a href="../../index2.html"><b>EXPLORE </b>Inc.</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
              <p class="login-box-msg">Enter verfication code provided in email</p>

              <form method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group has-feedback">
                  <?php echo e(Form::text('code', null, array('placeholder'=>'Enter code here','class'=>'form-control'))); ?>

                  <span class="glyphicon glyphicon-refresh form-control-feedback"></span>
                </div>
                <div class="row">
                  <!-- /.col -->
                  <div class="col-xs-4">
                    <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
                    <?php echo e(Form::submit('Proceed',array('name'=>'proceed','class'=>'btn btn-primary btn-block btn-flat'))); ?>

                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                  Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                  Google+</a>
              </div>
              <!-- /.social-auth-links -->

            </div>
            <!-- /.login-box-body -->
          </div>
          <!-- /.login-box --><?php
      } else if($value == 'Password Does Not Match'){
          ?><div class="login-box">
              <div class="login-logo">
                <a href="../../index2.html"><b>EXPLORE </b>Inc.</a>
              </div>
              <!-- /.login-logo -->
              <div class="login-box-body">
                <p class="login-box-msg">Please provide new password</p>

                <form method="post">
                  <?php echo e(csrf_field()); ?>

                  <div class="form-group has-feedback">
                    <?php echo e(Form::password('password', array('placeholder'=>'Password','class'=>'form-control'))); ?>

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <?php echo e(Form::password('rpassword', array('placeholder'=>'Repeat Password','class'=>'form-control'))); ?>

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                      <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
                      <?php echo e(Form::submit('Reset',array('name'=>'change_password','class'=>'btn btn-primary btn-block btn-flat'))); ?>

                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
                </div>
                <!-- /.social-auth-links -->

              </div>
              <!-- /.login-box-body -->
            </div>
            <!-- /.login-box --><?php
      }
  }
?>

<!-- jQuery 3.1.1 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script type="text/javascript" src="<?php echo e(URL::asset('AdminLTE/dist/js/icheck.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/login-script.js')); ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
