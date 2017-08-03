<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\passport;
use App\role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use DateTime;
use Auth;


class Mailer extends Controller
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

    public static function mail($email,$msg,$subject){
        $from = 'exploresociety@gmail.com';
        $name = 'Absolute Arpit';


        $mail = new \PHPMailer(true);
        $mail->IsSMTP(); // enable SMTP
        // $mail->SMTPDebug = 2;   // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        //$mail->SMTPAutoTLS = false;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'exploresociety@gmail.com';
        $mail->Password = 'explore123';
        $mail->setFrom($from,'Absolute Arpit');      
        $mail->Body = $msg;
        $mail->Subject = $subject;
        $mail->AddAddress($email);
        $mail->IsHTML(true);
        if(!$mail->Send()) {
            $result = 'false';
        } else {
            $result = 'true';
        }
        return $result;
    }
}
