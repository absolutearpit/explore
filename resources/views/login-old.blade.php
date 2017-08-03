<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('AlertifyJS/build/alertify.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/login-script.js') }}"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ URL::asset('css/login-style.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('AlertifyJS/build/css/alertify.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('AlertifyJS/build/css/themes/default.rtl.css') }}" />
    </head>
    <body>
    	<?php
    		if(isset($value)){
        		if($value == 'Failed')	{

                    echo "<script>";
        			echo "alertify.error('Wrong Username or Password');";
        			echo "</script>";
                } else if($value == 'Created'){
                    echo "<script>";
                    echo "alertify.alert('Explore','Registed Successfully.');";
                    echo "</script>";
                }   
    		}
    	?>
			<div class="login-page">
			  <div class="form">
			    <form method="post" class="register-form" enctype="multipart/form-data">
			    	{{csrf_field()}}
						{{ Form::text('fullname', null, array('placeholder'=>'Fullname')) }}
						{{ Form::text('explore_name', null, array('placeholder'=>'Explore Username')) }}
						{{ Form::email('email', null, array('placeholder'=>'Email')) }}
                        <label for="avatar">Select Avatar</label>
						{{ Form::file('avatar', ['id' => 'avatar', 'style'=>'display:none']) }}
                        <label for="cover">Select Cover</label>
                        {{ Form::file('cover', ['id' => 'cover', 'style'=>'display:none']) }}
                        {{ Form::select('gender', ['male' => 'Male','female' => 'Female'],null, ['style'=>'margin-top:20px;']) }}
						{{ Form::password('password', array('placeholder'=>'Password')) }}
						{{ Form::submit('create',array('name'=>'register')) }}
			      <p class="message">Already registered? <a href="#">Sign In</a></p>
			    </form>
			    <form method="post" class="login-form">
			    	{{csrf_field()}}
			    	{{ Form::text('username', null, array('placeholder'=>'explore username or email')) }}
			    	{{ Form::password('password', array('placeholder'=>'password')) }}
			    	{{ Form::submit('login',array('name'=>'login')) }}
			      <p class="message">Not registered? <a href="#">Create an account</a></p>
			    </form>
			  </div>
			</div>
    </body>
</html>
