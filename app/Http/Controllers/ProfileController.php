<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Explore\Post;
use App\Models\Explore\User;
use App\Models\Explore\Comment;
use App\Models\Explore\Notification;
use Session;
use DateTime;
use Adldap\Laravel\Facades\Adldap;

class ProfileController extends Controller {

	public function index(){
      $actionLogout = Input::get('logout');
      $updateProfile = Input::get('update_profile');
      $deleteProfile = Input::get('delete_profile');

      if(!empty($updateProfile) && $updateProfile == 'Update Profile'){
      	$values = Session::get('user_details');
      	$result = $this->updateProfile($values);
      	if($result == true){
      		$values = DB::table('register_users')->select('*')->where('id',$values->id)->first();
      		Session::put('user_details', $values);
      		return Redirect::back();
      	}
      }

      if(!empty($deleteProfile) && $deleteProfile == 'Delete Profile'){
        $user = Adldap::search()->findByDn("cn=mark,cn=email,dc=localhost");
        if(!empty($user)){
          $delete = $user->delete();
          if($delete == true){
            return view('login',['value' => 'Deleted']);
          } else {
            return redirect('profile');
          }
        } else {
          echo "<script>";
          echo "alertify.alert('Explore','User does not exist.');";
          echo "</script>";
        }
      }

      if(isset($actionLogout)){
         Session::flush();
         return redirect('login');
      }


    }

    public function updateProfile($values){

    	$fullName = Input::get('fullname');
    	$exploreName = Input::get('explore_name');
    	$email = Input::get('email');
    	$avatar = Input::file('avatar');
    	$cover = Input::file('cover');
    	$password = Input::get('password');
    	$mobile = Input::get('mobile');
      $about = Input::get('about');
      $country = Input::get('country');

    	if(!empty($fullName))
    		$result = DB::table('register_users')->where('id', $values->id)->update(['fullname' => $fullName]);
    	if(!empty($exploreName))
    		$result = DB::table('register_users')->where('id', $values->id)->update(['explore_name' => $exploreName]);
    	if(!empty($email))
    		$result = DB::table('register_users')->where('id', $values->id)->update(['email' => $email]);
    	if(!empty($password)){
        $values = Session::get('user_details');
        $currentExploreName = $values->explore_name;
        
        $user = Adldap::search()->findByDn("cn=$currentExploreName,cn=email,dc=localhost");
        $user->userpassword = $password;
        $modifyResult = $user->save();
        
        if($modifyResult == true){
          $result = DB::table('register_users')->where('id', $values->id)->update(['password' => md5($password)]);
        }
      }
    	if(!empty($mobile))
    		$result = DB::table('register_users')->where('id', $values->id)->update(['mobile' => $mobile]); 
    	if(!empty($avatar)){

    		$fileName = $avatar->getClientOriginalName();
            $extension = $avatar->getClientOriginalExtension();
            $avatar->move(public_path().'/images/avatar/',$values->explore_name.'.'.$extension);
            $userAvatar = "avatar/$values->explore_name.$extension";
    		$result = DB::table('register_users')->where('id', $values->id)->update(['avatar' => $userAvatar]);

    	}

    	if(!empty($cover)){

            $fileNameCover = $cover->getClientOriginalName();
            $extensionCover = $cover->getClientOriginalExtension();
            $cover->move(public_path().'/images/avatar/',$values->explore_name.'_cover.'.$extensionCover);
            $userAvatarCover = 'avatar/'.$values->explore_name.'_cover.'.$extensionCover;
    		$result = DB::table('register_users')->where('id', $values->id)->update(['cover' => $userAvatarCover]);
    		
    	}

      if(!empty($about))
        $result = DB::table('register_users')->where('id', $values->id)->update(['about' => $about]); 

      if(!empty($country))
        $result = DB::table('register_users')->where('id', $values->id)->update(['country' => $country]); 

      return true;
    }

	public static function profile($name){
		$values = Session::get('user_details');
		if($values->explore_name == $name){
			$profileDetails = 'Active';
			//$allUserPosts = DB::table('post')->join('register_users','post.user_id','register_users.id')->where('post.user_id',$values->id)->select('post.*','register_users.*','post.created_at as post_created','post.updated_at as post_updated')->orderBy('post.post_id','desc')->get();

      $allUserPosts = Post::with(['user'])->where('user_id','=',$values->id)->orderBy('id','desc')->get()->toArray();

      $allComments = Comment::with(['post','user'])->get()->toArray();

			$userPosts = array('profileDetails'=>$profileDetails,'allUserPosts'=>$allUserPosts,'allComments'=>$allComments);

			return $userPosts;
		} else {
			$profileDetails = User::all()->where('explore_name',$name)->toArray();
      foreach ($profileDetails as $profileDetails) {
        $profileDetails = $profileDetails;
      }

      //$profileDetails = DB::table('register_users')->select('*')->where('explore_name',$name)->first();
			//$allUserPosts = DB::table('post')->join('register_users','post.user_id','register_users.id')->where('post.user_id',$profileDetails->id)->select('post.*','register_users.*','post.created_at as post_created','post.updated_at as post_updated')->orderBy('post.post_id','desc')->get();
			
      $allUserPosts = Post::with(['user','comment'])->where('user_id','=',$profileDetails['id'])->orderBy('id','desc')->get()->toArray();    

      $allComments = Comment::with(['post','user'])->get()->toArray();

      $userPosts = array('profileDetails'=>$profileDetails,'allUserPosts'=>$allUserPosts,'allComments'=>$allComments);
			return $userPosts;
		}
	}
}