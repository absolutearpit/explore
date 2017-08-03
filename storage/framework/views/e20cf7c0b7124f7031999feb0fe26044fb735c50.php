<?php use App\Http\Controllers\UserController; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn1.iconfinder.com/data/icons/technology-and-hardware-2/200/vector_66_11-128.png">
    <title>User Profile</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/bootstrap/dist/css/bootstrap.min.css')); ?>" />
    <!-- Menu CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(URL::asset('AdminLTE/dist/css/AdminLTE.min.css')); ?>" />
    <!-- animation CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/css/animate.css')); ?>" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(URL::asset('ample/css/style.css')); ?>" />
    <!-- color CSS -->
    <link rel="stylesheet" id="theme" href="<?php echo e(URL::asset('ample/css/colors/default.css')); ?>" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">
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

li input[type=submit] {
    background: url(http://localhost:8000/images/logout.png);
    cursor: pointer;
    background-repeat: no-repeat;
    border: none;
    height: 32px;
    color: rgba(255, 255, 255, 0);
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
  width: 100%;
  cursor: pointer;
}

.overlay-box-custom{
    background:#707cd2;
    opacity:.7;
    position:absolute;
    top:0;left:0;
    right:0;
    height:100%;
    text-align:center
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

pre{
    border: none;
}
</style>
</head>

<body class="fix-header">


    <?php  $values = Session::get('user_details') ?>

    <?php
        // Session values : logged in user
        $active = $values->id;
        $avatar = $values->avatar;
        $fullName = $values->fullname;
        $email = $values->email;
        $exploreName = $values->explore_name;

        $allComments = $userPosts['allComments'];
        $userPosts = $userPosts['allUserPosts'];

    ?>
    <input type="hidden" id="user_id" value="<?php echo e($values->id); ?>">
    <input type="hidden" id="fullname" value="<?php echo e($values->fullname); ?>">
    <input type="hidden" id="explore_name" value="<?php echo e($values->explore_name); ?>">
    <input type="hidden" id="uniq_id" value="<?php echo e($values->uniq_id); ?>">
    <input type="hidden" id="email" value="<?php echo e($values->email); ?>">
    <input type="hidden" id="avatar" value="<?php echo e($values->avatar); ?>">

    <div id="wrapper">


        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">

                <a class="navbar-brand" href="/">Explore</a>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <?php echo e(Form::text('search_user', null, array('placeholder'=>'Search Users','id'=>'search_user', 'class'=>'form-control'))); ?>

                            <a href=""><i class="fa fa-search"></i></a>
                            
                        </form>
                        <div class='search_result'></div>
                    </li>
                    <li>
                        <a class="profile-pic" href="/profile/<?php echo e($values->explore_name); ?>"> 
                        <?php if(!empty($avatar)): ?>
                          <img src='<?php echo e(URL::asset("images/$values->avatar")); ?>' alt="user-img" width="36" class="img-circle">
                        <?php else: ?>
                          <img src="<?php echo e(URL::asset("images/default-avatar.png")); ?>" alt="user-img" width="36" class="img-circle">
                        <?php endif; ?>
                        <b class="hidden-xs"><?php echo e($values->fullname); ?></b></a>
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
        <div id="page-wrapper" style="margin-left: 0px; padding:40px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-xs-12" style="overflow: auto; height: 100%; padding-top: 40px;">
                        <div class="col-md-4 col-xs-12"></div>
                        <div class="col-md-4 col-xs-12">
                            <div class="row all_posts">
                                <?php if(isset($userPosts)): ?>
                                    <?php if(count($userPosts) > 0): ?>
                                        <?php $__currentLoopData = $userPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo $__env->make('post', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>                            
                        
                        </div>
                    </div> <!-- end main -->                    
                </div>
                <!-- /.row -->
            </div>

            <!-- /.container-fluid -->
            <footer class="footer text-center" style="margin-left: -240px;"> 2017 &copy; Explore Society brought to you by explore.in </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- custom css -->
    <script type="text/javascript" src="<?php echo e(URL::asset('js/scripts.js')); ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- Menu Plugin JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')); ?>"></script>
    <!--slimscroll JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/js/jquery.slimscroll.js')); ?>"></script>
    <!--Wave Effects -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/js/waves.js')); ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="<?php echo e(URL::asset('ample/js/custom.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('Accessible/jquery.popupoverlay.js')); ?>"></script>

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
</body>

</html>
