<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Models\Explore\Post;
use App\Models\Explore\User;
use App\Models\Explore\Comment;
use App\Models\Explore\Notification;

class PostController extends Controller {

   public function index(){
      $action = $_GET['action'];
      if($action == 'create'){
      	$post = $_GET['value'];
      	$postID = $this->createPost($post);
      	return response()->json(array('post_id'=> $postID), 200);
      } else if($action == 'delete'){
         $postID = $_GET['value'];
         $result = $this->deletePost($postID);
         return response()->json(array('result'=> $result), 200);
      } else if($action == 'update'){
         $newPost = $_GET['value'];
         $postID = $_GET['post_id'];
         $result = $this->updatePost($newPost,$postID);
         return response()->json(array('result'=> $result), 200);
      } else if($action == 'like'){
         $likesCountInt = $_GET['value'];
         $postID = $_GET['post_id'];
         $result = $this->likePost($likesCountInt,$postID);
         return response()->json(array('result'=> $result), 200);
      } else if($action == 'comment'){
         $comment = $_GET['value'];
         $postID = $_GET['post_id'];
         $result = $this->commentPost($comment,$postID);
         return response()->json(array('result'=> $result), 200);
      }
   }

   public function createPost($post){
   		$values = Session::get('user_details');
   		$postID = DB::table('post')->insertGetId(
                ['user_id' => $values->id, 'post' => $post, 'type' => 'text', 'liked_users' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime]
            );
   		if(!empty($postID)){
   			return $postID;
   		}
   }

   public function deletePost($postID){
      $result = DB::table('post')->where('id', $postID)->delete();
      return $result;
   } 

   public function updatePost($newPost,$postID){
      $result = DB::table('post')->where('id', $postID)->update(['post' => $newPost]);
      return $result;
   } 

   public function commentPost($comment,$postID){
      $values = Session::get('user_details');

      $post = DB::table('post')->select('*')->where('id',$postID)->get();
      if(!empty($post)){
         foreach ($post as $post) {
            $commentsCount = $post->comments;
         }
      }

      $postObj = Post::find($postID);
      $postObj->comments = $commentsCount+1;
      if($postObj->save()){
         $result = DB::table('post_comments')->insert(['post_id' => $postID, 'user_id' => $values->id, 'comment' => $comment,'created_at' => new DateTime,]);
      } else {
         $result = false;
      }
      return $result;
   }

   public function likePost($likesCountInt,$postID){
      $values = Session::get('user_details');
      $likedUsers = DB::table('post')->select('user_id','liked_users')->where('id',$postID)->get();
      foreach ($likedUsers as $likedUser) {
         $likedUsersID = $likedUser->liked_users;
         $postAuthor = $likedUser->user_id;
      }
      if(empty($likedUsersID)){
         $likedUsersFinal = $values->id;
      } else {
         $likedUsersFinal = "$likedUsersID,$values->id";
      }
      $notification = "$values->fullname liked your post";
      $james = DB::table('post')->where('id', $postID)->update(['likes' => $likesCountInt,'liked_users' => $likedUsersFinal]);
      $bond = DB::table('notifications')->insert(['sender' => $values->id, 'receiver' => $postAuthor, 'notification' => $notification, 'type' => 'request_accept', 'created_at' => new DateTime]);
      if($james == true && $bond == true){
         $result = true;
      }
   return $result;
   } 

   public static function single($postID){
      // $singlePost = DB::table('post')->join('register_users','post.user_id','register_users.id')->where('post.id',$postID)->select('post.*','register_users.*','post.created_at as post_created','post.updated_at as post_updated')->orderBy('post.id','desc')->get();

      $allUserPosts = Post::with(['user'])->where('id','=',$postID)->orderBy('id','desc')->get()->toArray();

      $allComments = Comment::with(['post','user'])->get()->toArray();

      $singlePost = array('allUserPosts'=>$allUserPosts,'allComments'=>$allComments);

      return $singlePost;
   }
}