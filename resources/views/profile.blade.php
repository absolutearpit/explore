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
    <link rel="stylesheet" href="{{ URL::asset('ample/bootstrap/dist/css/bootstrap.min.css') }}" />
    <!-- Menu CSS -->
    <link rel="stylesheet" href="{{ URL::asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('AdminLTE/dist/css/AdminLTE.min.css') }}" />
    <!-- animation CSS -->
    <link rel="stylesheet" href="{{ URL::asset('ample/css/animate.css') }}" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::asset('ample/css/style.css') }}" />
    <!-- color CSS -->
    <link rel="stylesheet" id="theme" href="{{ URL::asset('ample/css/colors/default.css') }}" />
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


.popup_visible #old_post{
  padding: 10px;
}

pre{
    border: none;
}
</style>
</head>

<body class="fix-header">
    <?php
        if(isset($result)){
            if($result == true)  {
                echo "<script>";
                echo "profileUpdated()";
                echo "</script>";
            } 
        }
    ?>
    <?php  
        if(isset($userPosts)){ 

            if(gettype($userPosts['profileDetails']) == 'string'){
                if($userPosts['profileDetails'] == 'Active'){
                    $values = Session::get('user_details');
                    $allComments = $userPosts['allComments'];
                    $userPosts = $userPosts['allUserPosts'];
                    $avatar = $values->avatar;
                    $cover = $values->cover;
                    $fullName = $values->fullname;
                    $mobile = $values->mobile;
                    $about = $values->about;
                    $country = $values->country;
                    $email = $values->email;
                    $exploreName = $values->explore_name;
                    $userID = $values->id;
                    $active = $values->id;
                }    
            } else if(gettype($userPosts['profileDetails']) == 'object' || gettype($userPosts['profileDetails']) == 'array') {
                
                $values = Session::get('user_details');
                $userDetails = $userPosts['profileDetails'];
                $allComments = $userPosts['allComments'];
                $userPosts = $userPosts['allUserPosts'];
                $userID = $userDetails['id'];
                $avatar = $userDetails['avatar'];
                $cover = $userDetails['cover'];
                $fullName = $userDetails['fullname'];
                $exploreName = $userDetails['explore_name'];
                $email = $userDetails['email'];
                $mobile = $userDetails['mobile'];
                $about = $userDetails['about'];
                $country = $userDetails['country'];
                $active = $values->id;
            }
        }
    ?>

    <?php 
        $response = UserController::notification($values->id,$userID); 
        foreach ($response as $inside) {
            $status = $inside->status;
        }
    ?>
    <?php
     $allCountry = array( 'England', 'India', 'USA', 'Canada', 'Thailand');
    ?>
    <?php 
        $root = $_SERVER['REQUEST_URI']; 
        $home = Session::get('home');
    ?>
    <!-- popup -->
    <div class="popup_visible" id='popup_visible_custom' style="display: none;">
        <div id="my_popup">
            <div class="row" >
                <div class="col-md-12">{{ Form::textarea('old_post', null, array('size'=>'40x5', 'id'=>'old_post')) }}</div>
            </div>
            <div class="row" >
                <div class="col-md-4"></div>
                <div class="col-md-6">{{ Form::button('update',array('name'=>'update_post', 'onClick'=>'updatePost(this.id)', 'class'=>'btn btn-success update_button my_popup_close')) }}</div>
            </div>
        </div>
    </div>

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <input type="hidden" id="user_id" value="{{$values->id}}">
    <input type="hidden" id="fullname" value="{{$values->fullname}}">
    <input type="hidden" id="explore_name" value="{{$values->explore_name}}">
    <input type="hidden" id="uniq_id" value="{{$values->uniq_id}}">
    <input type="hidden" id="email" value="{{$values->email}}">
    <input type="hidden" id="avatar" value="{{$values->avatar}}">

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">

                <a class="navbar-brand" href="{{$home}}">Explore</a>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            {{ Form::text('search_user', null, array('placeholder'=>'Search Users','id'=>'search_user', 'class'=>'form-control')) }}
                            <a href=""><i class="fa fa-search"></i></a>
                            
                        </form>
                        <div class='search_result'></div>
                    </li>
                    <li>
                        <a class="profile-pic" href="{{$root}}"> 
                        @if(!empty($avatar))
                          <img src='{{ URL::asset("images/$values->avatar") }}' alt="user-img" width="36" class="img-circle">
                        @else
                          <img src="{{ URL::asset("images/default-avatar.png") }}" alt="user-img" width="36" class="img-circle">
                        @endif
                        <b class="hidden-xs">{{$values->fullname}}</b></a>
                    </li>
                    <li style="padding: 14px; ">
                          <form method="post" > 
                            {{csrf_field()}}
                            {{ Form::submit('logout',array('name'=>'logout','class'=>'logout_button')) }}
                        </form>   
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" style="margin-left: 0px; padding:40px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> 
                            @if(empty($cover))    
                                <img width="100%" alt="user cover" src="{{ URL::asset('images/default-cover.jpg') }}">
                            @else
                                <img width="100%" alt="user cover" src="{{ URL::asset("images/$cover") }}">
                            @endif
                                <div class="overlay-box-custom"></div>
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)">
                                        @if(!empty($avatar))    
                                            <img src="{{ URL::asset("images/$avatar") }}" class="thumb-lg img-circle" alt="img"></a>
                                        @else
                                            <img src="{{ URL::asset('images/default-avatar.png') }}" class="thumb-lg img-circle" alt="img"></a>
                                        @endif
                                        <h4 class="text-white">{{$fullName}}</h4>
                                        <h5 class="text-white">{{$email}}</h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1>
                                        <!-- <button class="btn btn-default">Add Friend</button> -->
                                        @if($values->avatar !== $avatar)
                                            @if(isset($status))
                                                @if($status == 1)
                                                    <button id="{{$userID}}" class="btn btn-info" disabled="true">Request Sent</button>
                                                @elseif($status == 0)
                                                    <button id="{{$userID}}" disabled="true" class="btn btn-success">Friend</button>
                                                @endif
                                            @else
                                                    <button id="{{$userID}}" class="btn btn-default" onClick='addFriend(this.id)'>Add Friend</button>
                                            @endif
                                        @else
                                            <!-- Nothing to show -->
                                        @endif
                                    </h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-blue"><i class="ti-twitter"></i></p>
                                    <h1>0</h1><span>Friends</span> </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-blue"><i class="ti-twitter"></i></p>
                                    <h1>0</h1><span>Interest</span> </div>
                            </div>
                        </div>
                        @if($values->explore_name == $exploreName)
                        <div class="col-md-12 col-xs-12">
                            <div class="white-box">
                                <form method="post" enctype="multipart/form-data" class="form-horizontal form-material">
                                {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="fullname" placeholder="{{$fullName}}" class="form-control form-control-line"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Explore Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="explore_name" placeholder="{{$exploreName}}" class="form-control form-control-line"> </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" name="email" placeholder="{{$email}}" class="form-control form-control-line" name="example-email" id="example-email"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar" class="col-md-12">Avatar</label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control form-control-line" name="avatar" id="avatar"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cover" class="col-md-12">Cover</label>
                                        <div class="col-md-12">
                                            <input type="file"  class="form-control form-control-line" name="cover" id="cover"> </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" value="" class="form-control form-control-line"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" name="mobile" placeholder="{{$mobile}}" class="form-control form-control-line"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">About You</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="about" placeholder="{{$about}}" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="country">
<!--                                                 <option value="England">England</option>
                                                <option value="India">India</option>
                                                <option value="USA">USA</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Thailand">Thailand</option> -->
                                                @foreach($allCountry as $allCountry)
                                                    @if($allCountry == $country)
                                                        <option value="{{$allCountry}}" selected="selected">{{$allCountry}}</option>
                                                    @else
                                                        <option value='{{$allCountry}}'>{{$allCountry}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            {{ Form::submit('Update Profile',array('name'=>'update_profile','class'=>'btn btn-success')) }}
                                        </div>
                                        <div class="col-sm-6">
                                            {{ Form::submit('Delete Profile',array('name'=>'delete_profile','class'=>'btn btn-success')) }}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @else
                        <div class="col-md-12 col-xs-12">
                            <div class="white-box">
                                <h3 style="color: #76b852;">About Me</h3>
                                @if(!empty($about))<p style="text-align: justify; font-size: 12px;">{{$about}}</p>
                                @else<p style="text-align: justify; font-size: 12px;">Not yet added</p>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-3 col-xs-12"></div>
                        <div class="col-md-6 col-xs-12">
                            <form class="form-horizontal form-material">
                                  <div class="form-group">
                                  <label class="col-md-12">Your Post</label>
                                  <div class="col-md-12">
                                      {{ Form::textarea('post', null, array('size'=>'30x5','id'=>'post', 'class'=>"form-control form-control-line",'placeholder'=>'Write Here')) }}
                                  </div>
                              </div> 
                              <div class="form-group">
                                  <div class="col-md-6">
                                      {{ Form::button('upload',array('name'=>'upload', 'id'=>'upload_post', 'onClick'=>'uploadPost()', 'class'=>'btn btn-success')) }}
                                      {{ Form::button('cancel',array('name'=>'cancel', 'id'=>'cancel_post', 'onClick'=>'cancelPost()', 'class'=>'btn btn-success')) }}
                                  </div>
                              </div>                       
                            </form>
                        </div>
                    </div> <!-- end main -->
                    <div class="col-md-8 col-xs-12" style="overflow: auto; height: 600px; padding-top: 40px;">
                        <div class="col-md-2 col-xs-12"></div>
                        <div class="col-md-8 col-xs-12">

                            <div class="row all_posts">
                                @if(isset($userPosts))
                                    @if(count($userPosts) > 0)
                                        @foreach($userPosts as $userPost)
                                            @include('post');
                                        @endforeach
                                    @else
                                        @if($values->email == $email)
                                            <div class="post_card" id="no-post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class='post_content'>You have not created any post. Go and try one.</p>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="post_card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class='post_content'>{{$fullName}} has not created any post yet.</p>                                    
                                                    </div>
                                                </div>
                                            </div>                            
                                        @endif
                                    @endif
                                @endif
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
        <!-- jQuery 3.1.1 -->
    <script src="{{ URL::asset('AdminLTE/plugins/jQuery/jquery-3.1.1.min.js') }}"></script>

    <!-- Bootstrap 3.3.7 -->

    <!-- Slimscroll -->
    <script src="{{ URL::asset('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('AdminLTE/dist/js/demo.js') }}"></script>    
    <!-- jQuery -->
    <script type="text/javascript" src="{{ URL::asset('ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- custom css -->
    <script type="text/javascript" src="{{ URL::asset('js/scripts.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('ample/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script type="text/javascript" src="{{ URL::asset('ample/js/waves.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('ample/js/custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('Accessible/jquery.popupoverlay.js') }}"></script>
    <script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js"></script>
</body>

</html>
