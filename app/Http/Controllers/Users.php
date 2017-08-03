<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Users extends Controller {
   public function index(){
      $newKey = $_GET['value'];
      $users = DB::table('register_users')->select('explore_name')->where("fullname","like","%$newKey%")->get();

      if (count($users) > 0){
         foreach ($users as $user) {
            $allUsers[] = "<a href='http://localhost:8000/profile/".$user->explore_name."' ><p class='searched_user' >$user->explore_name</p></a>";
         }
      } else {
         $allUsers = "<p class='searched_user' >No user found</p>";
      }

      return response()->json(array('allUsers'=> $allUsers), 200);
   }
}