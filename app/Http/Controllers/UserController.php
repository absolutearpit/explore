<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserController extends Controller {
   public function index(){
      $action = $_GET['action'];
      if($action == 'Friend Request'){
         $userID = $_GET['value'];
         $result = $this->friendRequest($userID);
         return response()->json(array('result'=> $result), 200);
      } else if($action == 'Add Friend'){
      	$userID = $_GET['value'];
      	$result = $this->addFriend($userID);
      	return response()->json(array('result'=> $result), 200);
      } elseif($action == 'accept'){
         $nID = $_GET['value'];
         $result = $this->accept($nID);
         return response()->json(array('result'=> $result), 200);
      } elseif($action == 'cancel'){
         $nID = $_GET['value'];
         $result = $this->cancel($nID);
         return response()->json(array('result'=> $result), 200);
      } elseif($action == 'send'){
         $msg = $_GET['value'];
         $receiver = $_GET['user'];
         $result = $this->sendChat($msg,$receiver);
         return response()->json(array('result'=> $result), 200);
      } elseif($action == 'get'){
         $receiver = $_GET['user'];
         $result = $this->getChat($receiver);
         return response()->json(array('result'=> $result), 200);
      } elseif($action == 'accept'){
         $notID = $_GET['id'];
         $notificationType = $_GET['type'];
         $result = $this->acceptRequest($notID,$notificationType);
         return response()->json(array('result'=> $result), 200);
      }
   }

   public function addFriend($userID){
   		$values = Session::get('user_details');
   		$postID = DB::table('post')->insertGetId(
                ['user_id' => $values->id, 'post' => $post, 'type' => 'text', 'liked_users' => '', 'created_at' => new DateTime, 'updated_at' => new DateTime]
            );
   		if(!empty($postID)){
   			return $postID;
   		}
   }

   public function friendRequest($userID){
      $values = Session::get('user_details');
      $notification = "$values->fullname wants to be your friend";
      $result = DB::table('notifications')->insert(['sender' => $values->id, 'receiver' => $userID, 'notification' => $notification, 'type' => 'friend_request', 'created_at' => new DateTime]);
      return $result;
   }

   public function accept($nID){
      $values = Session::get('user_details');
      $type = DB::table('notifications')->select('type','sender')->where('n_id',$nID)->get();
      foreach ($type as $type) {
         if($type->type == 'friend_request'){
            $notification = "$values->fullname has accepted your friend request";
            $james = DB::table('notifications')->insert(['sender' => $values->id, 'receiver' => $type->sender, 'notification' => $notification, 'type' => 'request_accept', 'created_at' => new DateTime]);
            $bond = DB::table('notifications')->where('n_id', $nID)->update(['status' => 0]);

            if($james == true && $bond == true){
               $result = true;
            }
         } elseif($type->type = 'request_accept') {
            $result = DB::table('notifications')->where('n_id', $nID)->update(['status' => 0]);
         }
      }
      return $result;
      
   } 

   public function cancel($nID){
      $values = Session::get('user_details');
      $result = DB::table('notifications')->where('n_id', $nID)->update(['status' => 0]);  
      return $result;
   } 

   public static function notification($active,$friend){
      $notification = DB::table('notifications')->select('*')->where('sender',$active)->where('receiver',$friend)->where('type','friend_request')->get();
      return $notification;
   }

   public function sendChat($msg,$receiver){
      $values = Session::get('user_details');
      $active = $values->id;
      $avatar = $values->avatar;
      // chats
      $msgDetails = array(
                     'msg' => $msg,
                     'time' => date("h:i:sa"),
                     'date' => date("Y-m-d"),
                     'day' => date("l"),
                     'status' => 1
                  );
      $msgDetails = json_encode($msgDetails);

      // messages
      $threadDetails = array(
                        'msg' => $msg,
                        'time' => date("h:i:sa"),
                        'date' => date("Y-m-d"),
                        'day' => date("l"),
                        'user' => $active
                     );

      $thread = json_encode($threadDetails);

      // receiver details
      $receiverdetails = DB::table('register_users')->select('*')->where('explore_name',$receiver)->get();
      foreach ($receiverdetails as $receiverdetails) {
         $receiverID = $receiverdetails->id;
         $receiverFullname = $receiverdetails->fullname;
      }

      $users_white = "$active,$receiverID";
      $users_black = "$receiverID,$active";
      $messageHistory = DB::table('messages')->select('*')->where('users',$users_white)->orWhere('users',$users_black)->get();
      if(count($messageHistory) == 0){
         $result_message = DB::table('messages')->insert(['users' => $users_white, 'messages' => $thread, 'added' => new DateTime]);
      } else {
         $oldMessages = DB::table('messages')->select('*')->where('users',$users_white)->orWhere('users',$users_black)->get();
         foreach ($oldMessages as $oldMessages) {
            $oldMessage = $oldMessages->messages;
            $oldMessageID = $oldMessages->id;
         }
         $thread = "$thread=$oldMessage";




         $result_message = DB::table('messages')->where('id','=',$oldMessageID)->update(['messages' => $thread]);
      }

      $history = DB::table('chat')->select('*')->where('sender','=',$active)->where('receiver','=',$receiverID)->get();
      if(count($history) == 0){
         $result_chat = DB::table('chat')->insert(['sender' => $active, 'receiver' => $receiverID,'messages' => $msgDetails, 'added' => new DateTime]);
         if($result_chat == true){
            $finalResult = '<div class="row msg_container base_sent">
                                <div class="col-md-10 col-xs-10 ">
                                    <div class="messages msg_sent">
                                        <p>'.$msg.'</p>
                                        <time datetime="2009-11-13T20:00">'.date("l").'</time>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-2 avatar">
                                    <img src="http://localhost:8000/images/'.$avatar.'" class=" img-responsive ">
                                </div>
                            </div>';
         }
      } else {

         $oldMessages = DB::table('chat')->select('*')->where('sender','=',$active)->where('receiver','=',$receiverID)->get();
         foreach ($oldMessages as $oldMessages) {
            $oldMessage = $oldMessages->messages;
            $oldMessageID = $oldMessages->id;
         }
         $msgDetails = "$msgDetails=$oldMessage";
         $result_chat = DB::table('chat')->where('id','=',$oldMessageID)->update(['messages' => $msgDetails]);  
         if($result_chat == true){
            $finalResult = '<div class="row msg_container base_sent">
                             <div class="col-md-10 col-xs-10 ">
                                 <div class="messages msg_sent">
                                     <p>'.$msg.'</p>
                                     <time datetime="2009-11-13T20:00">'.date("l").'</time>
                                 </div>
                             </div>
                             <div class="col-md-2 col-xs-2 avatar">
                                 <img src="http://localhost:8000/images/'.$avatar.'" class=" img-responsive ">
                             </div>
                           </div>';            
         }       
      }

      return $finalResult;
   }

   public function getChat($receiverExploreName){
      $finalResult = '';
      $values = Session::get('user_details');
      $active = $values->id;
      $avatar = $values->avatar;

      $receiverdetails = DB::table('register_users')->select('*')->where('explore_name',$receiverExploreName)->get();
      foreach ($receiverdetails as $receiverdetails) {
         $receiverID = $receiverdetails->id;
         $receiverFullname = $receiverdetails->fullname;
         $receiverAvatar = $receiverdetails->avatar;
      }

      $history = DB::table('chat')->select('*')->where('sender','=',$receiverID)->where('receiver','=',$active)->where('status','=',1)->get();
      foreach ($history as $history) {
         $historyMessages = $history->messages;
         $oldMessageID = $history->id;
      }

      $messages = explode('=',$historyMessages);
      $updateMessage = array(); // new string of change status
      if(count($messages) > 1){
         foreach ($messages as $message) {
            $message = json_decode($message);
            $finalMessage = $message->msg;
            $finalMessageStatus = $message->status;
            if($finalMessageStatus == 1){
               $finalResult .= '<div class="row msg_container base_receive">
                                 <div class="col-md-2 col-xs-2 avatar">
                                     <img src="http://localhost:8000/images/'.$receiverAvatar.'" class=" img-responsive ">
                                 </div>
                                 <div class="col-xs-10 col-md-10">
                                     <div class="messages msg_receive">
                                         <p>'.$finalMessage.'</p>
                                         <time datetime="2009-11-13T20:00">'.date('l').'</time>
                                     </div>
                                 </div>
                             </div>';

               $newMsgObj = array(
                              'msg' => $finalMessage,
                              'time' => $finalMessageStatus,
                              'date' => $message->date,
                              'day' => $message->day,
                              'status' => 0,
                           );
               $newMsgObj = json_encode($newMsgObj);
               array_push($updateMessage,$newMsgObj);
            } else {
               $message = json_encode($message);
               array_push($updateMessage,$message);
            }
         }
      } else {
         foreach ($messages as $message) {
            $message = json_decode($message);
            $finalMessage = $message->msg;
            $finalMessageStatus = $message->status;
            if($finalMessageStatus == 1){
               $finalResult .= '<div class="row msg_container base_receive">
                                 <div class="col-md-2 col-xs-2 avatar">
                                     <img src="http://localhost:8000/images/'.$receiverAvatar.'" class=" img-responsive ">
                                 </div>
                                 <div class="col-xs-10 col-md-10">
                                     <div class="messages msg_receive">
                                         <p>'.$finalMessage.'</p>
                                         <time datetime="2009-11-13T20:00">'.date('l').'</time>
                                     </div>
                                 </div>
                             </div>';

               $newMsgObj = array(
                              'msg' => $finalMessage,
                              'time' => $finalMessageStatus,
                              'date' => $message->date,
                              'day' => $message->day,
                              'status' => 0,
                           );
               $newMsgObj = json_encode($newMsgObj);
               $result_chat = DB::table('chat')->where('id','=',$oldMessageID)->update(['messages' => $newMsgObj, 'added' => new DateTime]);  

            } else {
               $message = json_encode($message);
               $result_chat = DB::table('chat')->where('id','=',$oldMessageID)->update(['messages' => $message, 'added' => new DateTime]);
            }
         }
      } 
      
      if(count($updateMessage) > 1){
         //$updateMessage = json_encode($updateMessage);
         $updateMessage = implode('=',$updateMessage);
         $result_chat = DB::table('chat')->where('id','=',$oldMessageID)->update(['messages' => $updateMessage, 'added' => new DateTime]);
      }  

      if($result_chat == true){
         return $finalResult;
      }     
   }

    public function acceptRequest($notID,$notificationType){
      if($notificationType == 'friend_request'){
        $selectUsers =  "SELECT * FROM notifications WHERE n_id='".$notificationID."' LIMIT 1";
        $selectUsersResult = $conn->query($selectUsers);
        if ($selectUsersResult->num_rows > 0) {
          while($selectUsersRow = $selectUsersResult->fetch_assoc()) {
            $sender = $selectUsersRow['requested_user_id'];
            $receiver = $selectUsersRow['requesting_user_id'];


            // adding receiver as friend to sender
            $sql_sender = "SELECT * FROM `friends` WHERE explore_user_id = '".$sender."' LIMIT 1";
            $finalResult_sender = myfunction($sql_sender,$conn,$sender,$receiver);

            // adding sender as friend to receiver
            $sql_receiver = "SELECT * FROM `friends` WHERE explore_user_id = '".$receiver."' LIMIT 1";
            $finalResult_receiver = myfunction($sql_receiver,$conn,$receiver,$sender);

            if($finalResult_sender == true && $finalResult_receiver == true){
              $updateNotification = "UPDATE `notifications` SET `status`=0 WHERE n_id='".$notificationID."'";
              if ($conn->query($updateNotification) === TRUE) {
                $selectRequestingUserName = "SELECT fullname FROM `register_users` WHERE id='".$sender."' LIMIT 1";
                $requestingUserName = selectRecord($selectRequestingUserName,$conn);
                if(!empty($requestingUserName)){
                  $requestingUser = $requestingUserName['fullname'];
                }
                $insertNotification = "INSERT INTO `notifications`(`requested_user_id`, `requesting_user_id`, `notification`, `type`, `time`) VALUES ('".$receiver."','".$sender."','".$requestingUser." has accepted your request','request_accepted',NOW())";
                if ($conn->query($insertNotification) === TRUE) {
                  echo "updated";
                } else {
                  echo "We are still enhancing Explore";
                }
              } else {
                echo "Some issue";
              }
            }
          }
        }
      } else if($notificationType == 'request_accepted') {
        $notificationID =  $_POST['id'];
        $updateNotification = "UPDATE `notifications` SET `status`=0 WHERE n_id='".$notificationID."'";
        if ($conn->query($updateNotification) === TRUE) {
          echo "updated";
        } else {
          echo "We are still enhancing Explore";
        }
      } else if($notificationType == 'like'){
        $notificationID =  $_POST['id'];
        $updateNotification = "UPDATE `notifications` SET `status`=0 WHERE n_id='".$notificationID."'";
        if ($conn->query($updateNotification) === TRUE) {
          echo "updated";
        } else {
          echo "We are still enhancing Explore";
        }
      }     
    }

}