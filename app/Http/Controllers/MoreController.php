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
use Adldap\Laravel\Facades\Adldap;

class MoreController extends Controller {
   public function index(){
    $values = Session::get('user_details');
      if(!empty($values)){

        $search = Adldap::search()->findBy('cn', 'email');
        // $entries = $search->getEntries();
        // $search = json_decode($search);

        echo "<pre>";
        print_r($search->getAttributes());
        exit;

        $userID = $values->id;

        $allNotifications = DB::table('notifications')->join('register_users','notifications.sender','register_users.id')->select('notifications.*','register_users.*','notifications.status as notification_status','register_users.status as user_status')->where('notifications.receiver',$userID)->where('notifications.status',1)->get(); 

        // echo "<pre>";
        // print_r($allPosts);
        // exit;

        $object = array('allNotifications' => $allNotifications);

        return view('more', compact('object'));
      } else {
          return redirect('login');
      }
   }
}