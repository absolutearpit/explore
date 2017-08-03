<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn1.iconfinder.com/data/icons/technology-and-hardware-2/200/vector_66_11-128.png">
    <title>Explore More</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/bootstrap/dist/css/bootstrap.min.css')); ?>" />
    <!-- Menu CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('AdminLTE/dist/css/AdminLTE.min.css')); ?>" />
    <!-- toast CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/plugins/bower_components/toast-master/css/jquery.toast.css')); ?>" />
    <!-- morris CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/plugins/bower_components/morrisjs/morris.css')); ?>" />
    <!-- chartist CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/plugins/bower_components/chartist-js/dist/chartist.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')); ?>" />
    <!-- animation CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/css/animate.css')); ?>" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/css/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/chat.css')); ?>" />
    <!-- color CSS -->
    <link rel="stylesheet" id="theme" href="<?php echo e(URL::asset('ample/css/colors/default.css')); ?>" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>

img.avatar{
  width: 100%;
}

  .navbar-default .dropdown-menu.notify-drop {
  min-width: 330px;
  background-color: #fff;
  min-height: 360px;
  max-height: 360px;
}
.navbar-default .dropdown-menu.notify-drop .notify-drop-title {
  border-bottom: 1px solid #e2e2e2;
  padding: 5px 15px 10px 15px;
}
.navbar-default .dropdown-menu.notify-drop .drop-content {
  min-height: 280px;
  max-height: 280px;
  overflow-y: scroll;
}
.navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-track
{
  background-color: #F5F5F5;
}

.navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar
{
  width: 8px;
  background-color: #F5F5F5;
}

.navbar-default .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-thumb
{
  background-color: #ccc;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li {
  border-bottom: 1px solid #e2e2e2;
  padding: 10px 0px 5px 0px;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li:nth-child(2n+0) {
  background-color: #fafafa;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li:after {
  content: "";
  clear: both;
  display: block;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li:hover {
  background-color: #fcfcfc;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li:last-child {
  border-bottom: none;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li .notify-img {
  float: left;
  display: inline-block;
  width: 45px;
  height: 45px;
  margin: 0px 0px 8px 0px;
}
.navbar-default .dropdown-menu.notify-drop .allRead {
  margin-right: 7px;
}
.navbar-default .dropdown-menu.notify-drop .rIcon {
  float: right;
  color: #999;
}
.navbar-default .dropdown-menu.notify-drop .rIcon:hover {
  color: #333;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li a {
  font-size: 12px;
  font-weight: normal;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li {
  font-weight: bold;
  font-size: 11px;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li hr {
  margin: 5px 0;
  width: 70%;
  border-color: #e2e2e2;
}
.navbar-default .dropdown-menu.notify-drop .drop-content .pd-l0 {
  padding-left: 0;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li p {
  font-size: 11px;
  color: #666;
  font-weight: normal;
  margin: 3px 0;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li p.time {
  font-size: 10px;
  font-weight: 600;
  top: -6px;
  margin: 8px 0px 0px 0px;
  padding: 0px 3px;
  border: 1px solid #e2e2e2;
  position: relative;
  background-image: linear-gradient(#fff,#f2f2f2);
  display: inline-block;
  border-radius: 2px;
  color: #B97745;
}
.navbar-default .dropdown-menu.notify-drop .drop-content > li p.time:hover {
  background-image: linear-gradient(#fff,#fff);
}
.navbar-default .dropdown-menu.notify-drop .notify-drop-footer {
  border-top: 1px solid #e2e2e2;
  bottom: 0;
  position: relative;
  padding: 8px 15px;
}
.navbar-default .dropdown-menu.notify-drop .notify-drop-footer a {
  color: #777;
  text-decoration: none;
}
.navbar-default .dropdown-menu.notify-drop .notify-drop-footer a:hover {
  color: #333;
}

.dropdown-toggle span{
  position: absolute;
    top: 9px;
    right: 7px;
    text-align: center;
    font-size: 13px;
    padding: 2px 3px;
    line-height: .9;
}

.navbar-brand{
  font-size: 30px;
  padding: 18px;
}

.search_result{
    background: #535353;
    height: 150px;
    position: absolute;
    width: 170px;
    padding: 10px;
    margin: 5px;
    border-radius: 5px;
    color: #fff;
    display: none;
}

.search_result a{
  color: #fff;
}

.search_result a p{
  line-height: 1;
}

input[type=submit] {
  background: url(http://localhost:8000/images/logout.png);
  cursor: pointer;
  background-repeat: no-repeat;
  border: none;
  height: 32px;
  width: 32px;
  color: rgba(255, 255, 255, 0);
}

.form-material .form-control, .form-material .form-control.focus, .form-material .form-control:focus{
  border-right: 1px solid #707cd2;
    border-left: 1px solid #707cd2;
    padding: 10px;
}

.post_card{
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 400px;
  width: 400px;
  margin: 0 auto 50px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

.post_card p.post_content{
  text-align: justify;
  color: #76b852;
  font-weight: 600;
}

img.avatar{
  width: 100%;
  border-radius: 5px;
}

img.post_action{
  /* like and delete button */
  width: 50%;
  cursor: pointer;
}

p.post_content a{
  color:#000;  
}

p.post_content a:hover{
  color:#000;  
}

#demo {
    -webkit-transform: scale(0.8);
       -moz-transform: scale(0.8);
        -ms-transform: scale(0.8);
            transform: scale(0.8);
}
.popup_visible #demo {
    -webkit-transform: scale(1);
       -moz-transform: scale(1);
        -ms-transform: scale(1);
            transform: scale(1);
}

.popup_background{
  width: 30% !important;
  height: 35% !important;
  top:0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}

#demo_wrapper{
  width: 30% !important;
  height: 40% !important;
  position: absolute;
  top:0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}

.popup_visible #old_post{
  padding: 10px;
}

pre{
    border: none;
}
</style>
</head>

<body class="fix-header">
    <!-- get values -->
    <?php  $values = Session::get('user_details') ?>
    <?php $allNotifications = ($object['allNotifications']); ?>
    <?php $root = $_SERVER['REQUEST_URI']; ?>
    <?php 
      $home = Session::get('home');
    ?>

    <input type="hidden" id="user_id" value="<?php echo e($values->id); ?>">
    <input type="hidden" id="fullname" value="<?php echo e($values->fullname); ?>">
    <input type="hidden" id="explore_name" value="<?php echo e($values->explore_name); ?>">
    <input type="hidden" id="uniq_id" value="<?php echo e($values->uniq_id); ?>">
    <input type="hidden" id="email" value="<?php echo e($values->email); ?>">
    <input type="hidden" id="avatar" value="<?php echo e($values->avatar); ?>">

    <?php
        // Session values : logged in user
        $active = $values->id;
        $avatar = $values->avatar;
        $fullName = $values->fullname;
        $email = $values->email;
        $exploreName = $values->explore_name;
    ?>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">

                <a class="navbar-brand" href="<?php echo e($home); ?>">Explore</a>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell-o"></i>
                        <span>
                            <?php if(count($allNotifications) > 0): ?> 
                              <?php echo e(count($allNotifications)); ?>

                            <?php endif; ?>
                        </span>
                      </a>
                      <ul class="dropdown-menu notify-drop">
                        <div class="notify-drop-title">
                          <div class="row">
                            <div class="col-md-7 col-sm-7 col-xs-7">
                              <?php if(count($allNotifications) > 0): ?> 
                                You have <?php echo e(count($allNotifications)); ?> notifications
                              <?php else: ?>
                                You have no new Notification
                              <?php endif; ?>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5 text-right"><a href="" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="tümü okundu."><i class="fa fa-dot-circle-o"></i></a></div>
                          </div>
                        </div>
                        <!-- end notify title -->
                        <!-- notify content -->
                        <div class="drop-content">
                        <?php $__currentLoopData = $allNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allNotification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li id="<?php echo e($allNotification->n_id); ?>">
                            <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><a href="/profile/<?php echo e($allNotification->explore_name); ?>"><img src='<?php echo e(URL::asset("images/$allNotification->avatar")); ?>' class="avatar" alt=""></a></div></div>
                            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="/profile/<?php echo e($allNotification->explore_name); ?>"><?php echo e($allNotification->fullname); ?></a><a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                            <p><?php echo e($allNotification->notification); ?></p>
                            <p class="time"><?php echo e($allNotification->created_at); ?></p>
                            <div style="cursor: pointer; display: flex;">
                              <p id="<?php echo e($allNotification->n_id); ?>-<?php echo e($allNotification->type); ?>" onClick="notificationAccept(this.id)">Accept</p>
                              <p id="<?php echo e($allNotification->n_id); ?>-<?php echo e($allNotification->type); ?>" onClick="notificationCancel(this.id)" style="padding-left: 5px;">Decline</p>
                            </div>
                            </div>
                          </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="notify-drop-footer text-center">
                          <a href=""><i class="fa fa-eye"></i> End</a>
                        </div>
                      </ul>
                    </li>
                    <?php if($exploreName == 'admin'): ?>
                      <li><a href="<?php echo e($root); ?>">More</a></li>
                    <?php endif; ?>
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <?php echo e(Form::text('search_user', null, array('placeholder'=>'Search Users','id'=>'search_user', 'class'=>'form-control'))); ?>

                            <a href=""><i class="fa fa-search"></i></a>
                            
                        </form>
                        <div class='search_result'></div>
                    </li>
                    <li>
                        <a class="profile-pic" href="<?php echo e($home); ?>profile/<?php echo e($exploreName); ?>"> 
                        <?php if(!empty($avatar)): ?>
                          <img src="<?php echo e(URL::asset("images/$avatar")); ?>" alt="user-img" width="36" class="img-circle">
                        <?php else: ?>
                          <img src="<?php echo e(URL::asset("images/default-avatar.png")); ?>" alt="user-img" width="36" class="img-circle">
                        <?php endif; ?>
                        <b class="hidden-xs"><?php echo e($fullName); ?></b></a>
                    </li>
                    <li style="padding: 14px; ">
                        <form method="post" > 
                          <?php echo e(csrf_field()); ?>

                          <?php echo e(Form::submit('logout',array('name'=>'logout','class'=>'logout_button'))); ?>

                        </form>   
                      </button>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" style="margin-left: 0px; padding-top:10px;">
          
            <!-- /.container-fluid -->
            <!-- <footer class="footer text-center" style="margin-left: -240px;"> 2017 &copy; Explore Society brought to you by explore.in </footer> -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
   
        <!-- jQuery 3.1.1 -->
    <script src="<?php echo e(URL::asset('AdminLTE/plugins/jQuery/jquery-3.1.1.min.js')); ?>"></script>

    <!-- Bootstrap 3.3.7 -->

    <!-- Slimscroll -->
    <script src="<?php echo e(URL::asset('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(URL::asset('AdminLTE/plugins/fastclick/fastclick.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(URL::asset('AdminLTE/dist/js/adminlte.min.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(URL::asset('AdminLTE/dist/js/demo.js')); ?>"></script>
   
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
  
    <!-- custom -->
    <script type="text/javascript" src="<?php echo e(URL::asset('js/scripts.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/chat.js')); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- Menu Plugin JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script>
    <!--slimscroll JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/js/jquery.slimscroll.js')); ?>"></script>
    <!--Wave Effects -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/js/waves.js')); ?>"></script>
    <!--Counter js -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/waypoints/lib/jquery.waypoints.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/counterup/jquery.counterup.min.js')); ?>"></script>
    <!-- chartist chart -->
    <!-- Sparkline chart JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')); ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/js/custom.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/js/dashboard1.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/toast-master/js/jquery.toast.js')); ?>"></script>
    <script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js"></script>

</body>

</html>
