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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">

<?php
  if(isset($value)){
      if($value == 'Failed')  {
          echo "<script>";
          echo "alertify.error('Wrong Username or Password');";
          echo "</script>";
      } else if($value == 'Created'){
          echo "<script>";
          echo "alertify.alert('Explore','Registed Successfully.');";
          echo "</script>";
      } else if($value == 'Sent'){
          echo "<script>";
          echo "alertify.alert('Explore','An email has been sent.');";
          echo "</script>";
      } else if($value == 'Email Not Found'){
          echo "<script>";
          echo "alertify.alert('Explore','Given email is not registered.');";
          echo "</script>";
      } else if($value == 'Reset Complete'){
          echo "<script>";
          echo "alertify.alert('Explore','Password Reset. Please Login.');";
          echo "</script>";
      }  else if($value == 'Ldap error'){
          echo "<script>";
          echo "alertify.alert('Explore','Something went wrong. We are working on it.');";
          echo "</script>";
      }
  }
?>

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>EXPLORE </b>Inc.</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post">
      <?php echo e(csrf_field()); ?>

      <div class="form-group has-feedback">
        <input type="text" name="username" placeholder="explore username or email" value='<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>' class="form-control">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" placeholder="password" value='<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>' class="form-control">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_me[]" id="remember_me" value='remember_me' <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?>> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
          <?php echo e(Form::submit('login',array('name'=>'login','class'=>'btn btn-primary btn-block btn-flat'))); ?>

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

    <a href="#" class="forgot-password">I forgot my password</a><br>
    <a href="#" class="text-center login-hide">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->

  <div class="register-box-body" style="display: none;">
    <p class="login-box-msg">Register a new membership</p>

    <form action="" method="post">
    <?php echo e(csrf_field()); ?>

      <div class="form-group has-feedback">
        <?php echo e(Form::text('fullname', null, array('placeholder'=>'Fullname','class'=>'form-control'))); ?>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo e(Form::text('explore_name', null, array('placeholder'=>'Explore Username','class'=>'form-control'))); ?>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo e(Form::email('email', null, array('placeholder'=>'Email','class'=>'form-control'))); ?>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo e(Form::select('gender', ['male' => 'Male','female' => 'Female'],null, ['class'=>'form-control'])); ?>

        <span class="fa fa-intersex form-control-feedback" style="font-size:18px"></span>
      </div>      
      <div class="form-group has-feedback">
        <?php echo e(Form::password('password', array('placeholder'=>'Password','class'=>'form-control'))); ?>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" id="term" name="term"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <div id='clickable'></div>
          <?php echo e(Form::submit('create',array('name'=>'register','id' => 'create','disabled' ,'class' => 'btn btn-primary btn-block btn-flat'))); ?>

        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="#" class="text-center register-hide">I already have a membership</a>
  </div>
  <!-- /.form-box -->

  <div class="forgot-password-box-body" style="display: none;">
    <p class="login-box-msg">Enter registered email address</p>

    <form action="" method="post">
    <?php echo e(csrf_field()); ?>

      <div class="form-group has-feedback">
        <?php echo e(Form::email('email', null, array('placeholder'=>'Email','class'=>'form-control'))); ?>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>     
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <?php echo e(Form::submit('submit',array('name'=>'forgot_password','class' => 'btn btn-primary btn-block btn-flat'))); ?>

        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="#" class="text-center register-hide">I already have a membership</a>
  </div>
  <!-- /.form-box -->

</div>
<!-- /.login-box -->

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
