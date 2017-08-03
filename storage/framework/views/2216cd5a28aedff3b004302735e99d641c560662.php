<!DOCTYPE html>
<html>
<head>
	<title>Score</title>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn1.iconfinder.com/data/icons/technology-and-hardware-2/200/vector_66_11-128.png">
    <title>Explore Home</title>
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

			.widget-user-header .bg-aqua-active h3{
				color: #fff !important;
			}
		</style>
</head>
<body style="background: #eae8e8;">
<?php if(isset($result)): ?>
<?php
  $batsmansCount = count($result->query->results->Scorecard->past_ings->d->a->t);
  $batsmans = $result->query->results->Scorecard->past_ings->d->a->t;
  for($i=0;$i<$batsmansCount;$i++) {
     //echo $batsman->name.' '.$batsman->r.'(runs) '.$batsman->b.'(balls) '.$batsman->sr.'(SR) '.$batsman->four.'(fours) '.$batsman->six.'(sixes)<br>';
     $batsman = array("name" => $batsmans[$i]->name,"runs" => $batsmans[$i]->r,"balls" => $batsmans[$i]->b,"sr" => $batsmans[$i]->sr);
  }
?>
<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<?php
			foreach ($batsmans as $batsman) {
				?>

				<div class="col-md-4">
			    <!-- Widget: user widget style 1 -->
			    <div class="box box-widget widget-user">
			      <!-- Add the bg color to the header using any of the bg-* classes -->
			      <div class="widget-user-header bg-aqua-active">
			        <h3 class="widget-user-username"><?php echo e($batsman->name); ?></h3>
			        <h5 class="widget-user-desc">Batting</h5>
			      </div>
			      <div class="widget-user-image">
			        <img class="img-circle" src="http://highlightsandshows.com/wp-content/uploads/2017/01/india-cricket.png" alt="User Avatar">
			      </div>
			      <div class="box-footer">
			        <div class="row">
			          <div class="col-sm-4 border-right">
			            <div class="description-block">
			              <h5 class="description-header"><?php echo e($batsman->r); ?></h5>
			              <span class="description-text">Runs</span>
			            </div>
			            <!-- /.description-block -->
			          </div>
			          <!-- /.col -->
			          <div class="col-sm-4 border-right">
			            <div class="description-block">
			              <h5 class="description-header"><?php echo e($batsman->b); ?></h5>
			              <span class="description-text">Balls</span>
			            </div>
			            <!-- /.description-block -->
			          </div>
			          <!-- /.col -->
			          <?php
			          	$sr = $batsman->sr;
			          	$sr = substr($sr,0,5);
			          ?>
			          <div class="col-sm-4">
			            <div class="description-block">
			              <h5 class="description-header"><?php echo e($sr); ?></h5>
			              <span class="description-text">SR</span>
			            </div>
			            <!-- /.description-block -->
			          </div>
			          <!-- /.col -->
			        </div>
			        <!-- /.row -->
			      </div>
			    </div>
			    <!-- /.widget-user -->
			  </div>

				<?php
			}
			?>
		</div>
	</div>
</section>
<?php endif; ?>
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