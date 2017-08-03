<?php use App\Http\Controllers\UserController; ?>
<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/scripts.js') }}"></script>
        <!-- <script type="text/javascript" src="{{ URL::asset('jBox/Source/jBox.js') }}"></script> -->
        <script type="text/javascript" src="{{ URL::asset('Accessible/jquery.popupoverlay.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('AlertifyJS/build/alertify.js') }}"></script>

        <!-- Styles -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" />
        <!-- <link rel="stylesheet" href="{{ URL::asset('jBox/Source/jBox.css') }}" /> -->
        <link rel="stylesheet" href="{{ URL::asset('AlertifyJS/build/css/alertify.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('AlertifyJS/build/css/themes/default.rtl.css') }}" />

    </head>
    <body>
        <?php  
            if(gettype($userPosts[0]) == 'string'){
                if($userPosts[0] == 'Active'){
                    $values = Session::get('user_details');
                    $userPosts = $userPosts[1];
                    $avatar = $values->avatar;
                    $fullName = $values->fullname;
                    $email = $values->email;
                    $exploreName = $values->explore_name;
                    $userID = $values->id;
                }    
            } else if(gettype($userPosts[0]) == 'object' || gettype($userPosts[0]) == 'array') {
                $values = Session::get('user_details');
                $userDetails = $userPosts[0];
                $userPosts = $userPosts[1];
                $userID = $userDetails->id;
                $avatar = $userDetails->avatar;
                $fullName = $userDetails->fullname;
                $email = $userDetails->email;
            }
        ?>
        <?php 
            $response = UserController::notification($values->id,$userID); 
            foreach ($response as $inside) {
                $status = $inside->status;
            }
        ?>
        <div class="container-fluid">
            <!-- popup -->
            <div class="popup_visible" id='popup_visible_custom' style="display: none;">
                <div id="demo">
                    <div class="row" >
                        <div class="col-md-12">{{ Form::textarea('old_post', null, array('size'=>'40x5', 'id'=>'old_post')) }}</div>
                    </div>
                    <div class="row" >
                        <div class="col-md-2"></div>
                        <div class="col-md-8">{{ Form::button('update',array('name'=>'update_post', 'onClick'=>'updatePost(this.id)', 'class'=>'post_button update_button')) }}</div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="user_id" value="{{$values->id}}">
            <input type="hidden" id="fullname" value="{{$values->fullname}}">
            <input type="hidden" id="explore_name" value="{{$values->explore_name}}">
            <input type="hidden" id="uniq_id" value="{{$values->uniq_id}}">
            <input type="hidden" id="email" value="{{$values->email}}">
            <input type="hidden" id="avatar" value="{{$values->avatar}}">

            <div class="row">
                <div class='col-md-3'>
                    <div class="white_area" style="margin-top: 10px; margin-left:0px;">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <img src='{{ URL::asset("images/$avatar") }}' class="avatar"> 
                            </div>
                        </div>
                        <div class="row">
                            <p class="profile_data" >{{$fullName}}</p>
                        </div>
                        <div class="row">
                            <p class="profile_data" >{{$email}}</p>
                        </div>
                        <div class="row">
                            <p class="profile_data" ><a href="/">Home</a></p>
                        </div>
                        @if($values->avatar !== $avatar)
                            <div class="row">
                                @if(isset($status))
                                    @if($status == 1)
                                        <p class="profile_data" ><button id="{{$userID}}">Request Sent</button></p>
                                    @elseif($status == 0)
                                        <p class="profile_data" ><button id="{{$userID}}">Friend</button></p>
                                    @endif
                                @else
                                    <p class="profile_data" ><button id="{{$userID}}" onClick='addFriend(this.id)'>Add Friend</button></p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class='col-md-3' style="margin-left:185px;">
                    <div class="row">
                        <div class="col-sm-12" > 
                            {{ Form::textarea('post', null, array('size'=>'30x5', 'id'=>'post' ,'placeholder'=>'Write your post')) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::button('upload',array('name'=>'upload', 'id'=>'upload_post', 'onClick'=>'uploadPost()', 'class'=>'post_button')) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::button('cancel',array('name'=>'cancel', 'id'=>'cancel_post', 'onClick'=>'cancelPost()', 'class'=>'post_button')) }}
                        </div>                    
                    </div>
                </div>
                <div class='col-md-2'></div>
                <div class='col-md-4' style="display: inline;">
                    <div class='row' >
                        <div class='col-md-6'>{{ Form::text('search_user', null, array('placeholder'=>'Search Users','id'=>'search_user', 'class'=>'search_input')) }}</div>
                        <div class='col-md-6'>
                            <form method="post" > 
                                {{csrf_field()}}
                                {{ Form::submit('logout',array('name'=>'logout','class'=>'logout_button')) }}
                            </form>    
                        </div>
                    </div>
                    <div class="row">
                        <div class='search_result' ></div>
                    </div>
                </div>
            </div>
            <div class="row all_posts" style="">
                @if(isset($userPosts))
                    @if(count($userPosts) > 0)
                        @foreach($userPosts as $userPost)
                            <div class="post_card" id="{{$userPost->post_id}}">
                                <div class="row" style="margin-bottom: 15px;">
                                    <div class="col-md-3" >
                                        <img src='{{ URL::asset("images/$avatar") }}' class="avatar">  
                                    </div>
                                    <div class="col-md-6" >
                                        <h5>{{$fullName}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class='post_content' id="post-{{$userPost->post_id}}">{{$userPost->post}}</p>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php
                                            $createdAt = $userPost->created_at;
                                            $createdAt = explode(' ',$createdAt);
                                            $createdDate = $createdAt[0];
                                            $likedUsers = $userPost->liked_users;
                                            if (preg_match('/[,]/', $likedUsers)){
                                                $likedUsers = explode(',',$likedUsers);
                                            } else {
                                                $likedUsers = array($likedUsers);
                                            }                                      
                                        ?>
                                        <p>{{$createdDate}}</p>                                    
                                    </div>
                                    <div class="col-md-2"></div>
                                    @if($values->email == $email)
                                        <div class="col-md-2">
                                            <img src='{{ URL::asset("images/edit.png") }}' id="edit:{{$userPost->post_id}}" onclick="editPost(this.id)" class="post_action demo_open"> 
                                        </div>                                
                                        <div class="col-md-2">
                                            <img src='{{ URL::asset("images/delete.png") }}' id="delete:{{$userPost->post_id}}" onclick="deletePost(this.id)" class="post_action">                               
                                        </div>
                                        @if(in_array($values->id,$likedUsers) || $values->id == $likedUsers)
                                            <div class="col-md-2">
                                                <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" class="post_action">
                                            </div>
                                        @else
                                            <div class="col-md-2">
                                                <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" onclick="likePost(this.id)" class="post_action">         
                                            </div>
                                        @endif
                                    @else
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2"></div>
                                        @if(in_array($values->id,$likedUsers) || $values->id == $likedUsers)
                                            <div class="col-md-2">
                                                <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" class="post_action">
                                            </div>
                                        @else
                                            <div class="col-md-2">
                                                <img src='{{ URL::asset("images/like.png") }}' id="like-{{$userPost->post_id}}" onclick="likePost(this.id)" class="post_action">         
                                            </div>
                                        @endif
                                    @endif                                
                                </div>
                                <div class="row">
                                    <div class="col-md-9"></div>
                                    <div class="col-md-3"><p class="likes"><span class="likes_count" >{{$userPost->likes}}</span> Likes</p></div>
                                </div>
                            </div>
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

        <!-- scripts -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
