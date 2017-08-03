<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Explore\Post;
use App\Models\Explore\User;
use App\Models\Explore\Notification;
use App\Models\Explore\Comment;
use Carbon;

class HomeController extends Controller {
   public function index(){
      $actionLogout = Input::get('logout');

      if(isset($actionLogout)){
         Session::flush();
         return redirect('login');
      }
   }

   public function allPosts(){

   	$values = Session::get('user_details');
      if(!empty($values)){
        $userID = $values->id;

        // $allPosts = DB::table('post')->join('register_users','post.user_id','register_users.id')->select('post.*','register_users.*','post.created_at as post_created','post.updated_at as post_updated')->orderBy('post.post_id','desc')->get();

        $allPosts = Post::with(['user'])->orderBy('id','desc')->get()->toArray();

        // $allUsers = DB::table('register_users')->select('*')->where('id','!=',$userID)->orderBy('register_users.fullname','asc')->get();
        $allUsers = User::all()->where('id','!=',$userID)->toArray();


        $allNotifications = DB::table('notifications')->join('register_users','notifications.sender','register_users.id')->select('notifications.*','register_users.*','notifications.status as notification_status','register_users.status as user_status')->where('notifications.receiver',$userID)->where('notifications.status',1)->get(); 

        $allComments = Comment::with(['post','user'])->get()->toArray();

        // echo "<pre>";
        // print_r($allPosts);
        // exit;

        $object = array('allPosts' => $allPosts,'allUsers' => $allUsers,'allNotifications' => $allNotifications, 'allComments' => $allComments);

        return view('explore', compact('object'));
      } else {
          return redirect('login');
      }
   }

   public static function getPostTime($createdAt){
      $createdAt = explode(" ", $createdAt);
      $date = $createdAt[0];
      $time = $createdAt[1];

      $today = date('Y-m-d');
      $postDay = $date;


      $diff=date_diff(date_create($postDay),date_create($today));

      // convert 24 hours to 12
      $time = explode(':',$time);
      $hours = $time[0];
      $minutes = $time[1];
      $seconds = $time[2];
      $time = date('h:i A',strtotime("$hours:$minutes:$seconds"));

      // get weekday and month name
      $date = explode("-",$date);
      $year = $date[0];
      $month = $date[1];
      $day = $date[2];
      $weekDay = date('D',strtotime("$year-$month-$day"));
      $monthText = date('M',strtotime("$year-$month-$day"));

      // get current date
      $today = date("Y-m-d");
      $today = explode("-",$today);
      $todayYear = $today[0];
      $todayMonth = $today[1];
      $todayDay = $today[2];

      // compare and see how old this post is
      if($todayYear == $year && $todayMonth == $month && $todayDay == $day){
        $postUploadedTime = "$time Today";
      } else if($todayYear == $year && $todayMonth == $month && $todayDay == $day+1){
        $postUploadedTime = $diff->format("%a days ago");
      } else {
        $postUploadedTime = $diff->format("%a days ago");
      }
      return $postUploadedTime;
   }
}