<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use DateTime;
use Session;
use App\Http\Controllers\Mailer;
use Adldap\Laravel\Facades\Adldap;

class AuthenticateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate()
    {
        $actionLogin = Input::get('login');
        $actionRegister = Input::get('register');
        $actionForgotPassword = Input::get('forgot_password');
        $actionProceed = Input::get('proceed'); // proceed with code 
        $actionChangePassword = Input::get('change_password');

        if(isset($actionRegister)){;
            $name = Input::get('fullname');
            $exploreName = Input::get('explore_name');
            $email = Input::get('email');
            // $avatar = Input::file('avatar');
            // $cover = Input::file('cover');
            $gender = Input::get('gender');
            $password = Input::get('password');

            $name = explode(' ',$name);
            $firstName = $name[0];
            $lastName = $name[1];

            // Creating a user.
            $user = Adldap::make()->user([
                'displayName'   => $firstName,
                'uid'           => $exploreName,
                'cn'            => $exploreName,
                'sn'            => $lastName, // second name
                'mail'          => $email,
                'userpassword'  => $password,
             ]);
            $user->setAttribute('objectclass', 'inetOrgPerson');
            $user->setDn("cn=$exploreName,cn=email,dc=localhost");

            $result = $user->save();

            if($result == true){
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 7; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                $result = DB::table('register_users')->insert(
                    ['uniq_id' => $randomString, 'fullname' => "$firstName $lastName", 'explore_name' => $exploreName, 'email' => $email,'gender' => $gender,'mobile' => '','about' => '','password' => md5($password), 'avatar' => '','cover' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime]
                );

                if($result == true){
                    return view('login',['value' => 'Created']);
                } 
            } else {
                return view('login',['value' => 'Ldap error']);
            }

            // if(!empty($avatar)){
            //     $fileName = $avatar->getClientOriginalName();
            //     $extension = $avatar->getClientOriginalExtension();
            //     $avatar->move(public_path().'/images/avatar/',$exploreName.'.'.$extension);
            //     $userAvatar = "avatar/$exploreName.$extension";
            // } else{
            //     $userAvatar = '';
            // }

            // if (!empty($cover)){
            //     $fileNameCover = $cover->getClientOriginalName();
            //     $extensionCover = $cover->getClientOriginalExtension();
            //     $cover->move(public_path().'/images/avatar/',$exploreName.'_cover.'.$extensionCover);            
            //     $userAvatarCover = 'avatar/'.$exploreName.'_cover.'.$extensionCover;
            // } else{
            //     $userAvatarCover = '';
            // }

            // uniq id



        } else if(isset($actionLogin)) {

            $username = Input::get('username');
            $password = Input::get('password');

            $search = Adldap::search()->where('cn', '=', $username)->get()->toJson();
            $search = json_decode($search);

            // echo "<pre>";
            // print_r($search);
            // exit;

            foreach ($search as $key => $user) {
                $realpassword = $user->userpassword[0];
                if($realpassword === $password){
                    $values = DB::table('register_users')->select('*')->where('email',$username)->orWhere('explore_name',$username)->first();
                    if (!empty($values)) {

                        $rememberMe = Input::get('remember_me');
                        if(isset($rememberMe)){
                            setcookie ("username",$username,time()+ (10 * 365 * 24 * 60 * 60));
                            setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                        } else {
                            if(isset($_COOKIE["username"])) {
                                setcookie ("username","");
                            }
                            if(isset($_COOKIE["password"])) {
                                setcookie ("password","");
                            }
                        }

                        Session::put('user_details', $values);
                        return redirect('/');
                    } else {
                        return view('login',['value' => 'Failed']);
                    }
                } else {
                    return view('login',['value' => 'Failed']);
                }
            }
        } else if(isset($actionForgotPassword)){
            $email = Input::get('email');
            $values = DB::table('register_users')->select('*')->where('email',$email)->first();
            Session::put('user_details', $values);
            if(!empty($values)){
                $code = (rand(100000,999999));
                Session::put('code', $code);
                $subject = 'Password reset request';
                $msg = "Hi $values->fullname,<br><br>Please use below code to reset password.<br><br><b>$code</b><br><br>Let us know if it's not you.<br><br>Thank You<br>Team Explore";
                $response = Mailer::mail($email,$msg,$subject);
                if($response == true){
                    return view('reset',['value' => 'Sent']);
                }
            } else {
                return view('login',['value' => 'Email Not Found']);
            }
        } else if(isset($actionProceed)){
            $code = Input::get('code');
            $realCode = Session::get('code');

            if($code == $realCode){
                return view('reset',['value' => 'Correct Code']);
            } else {
                return view('reset',['value' => 'Wrong Code']);
            }
        } else if(isset($actionChangePassword)){
            $password = Input::get('password');
            $rpassword = Input::get('rpassword');
            if($password === $rpassword){
                $values = Session::get('user_details');
                $result = DB::table('register_users')->where('id', $values->id)->update(['password' => md5($password)]); 
                if($result == true){
                    return view('login',['value' => 'Reset Complete']);
                }
            } else {
                return view('reset',['value' => 'Password Does Not Match']);
            }
        }
    }
}
