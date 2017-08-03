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

class CricketController extends Controller {

   public function index(){

      $cSession = curl_init(); 
      $url = 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.scorecard.live.summary&format=json&diagnostics=true&env=store%3A%2F%2F0TxIGQMQbObzvU4Apia0V0&callback=';
   
      curl_setopt($cSession,CURLOPT_URL,$url);
      curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($cSession,CURLOPT_HTTPGET, TRUE);
      curl_setopt($cSession, CURLOPT_RETURNTRANSFER, 1);

      $request=curl_exec($cSession);
      curl_close($cSession);

      $result = json_decode($request);

      if(isset($_GET['action']) && $_GET['action'] == 'home'){

         if(!empty($result)){

            $matchStatus = $result->query->results->Scorecard->ms;
            $battingTeamID = $result->query->results->Scorecard->past_ings->s->t;
            $battingTeam = $result->query->results->Scorecard->teams[$battingTeamID]->fn;
            $runs = $result->query->results->Scorecard->past_ings->s->a->r;
            $runRate = $result->query->results->Scorecard->past_ings->s->a->cr;
            $overs = $result->query->results->Scorecard->past_ings->s->a->o;
            $wickets = $result->query->results->Scorecard->past_ings->s->a->w;
            $inning = $result->query->results->Scorecard->past_ings->s->i;
            $day = $result->query->results->Scorecard->past_ings->s->dm;
            switch ($inning) {
               case 1:
                  $innings = '1st Inning';
                  break;
               case 2:
                  $innings = '2nd Inning';
                  break;
               case 3:
                  $innings = '3rd Inning';
                  break;
               case 4:
                  $innings = '4th Inning';
                  break;                           
               default:
                  $innings = 'No inning';
                  break;
            }

            $finalResult = array('matchStatus'=>$matchStatus,'runs'=>$runs,'runRate'=>$runRate,'battingTeam'=>$battingTeam,'overs'=>$overs,'wickets'=>$wickets,'innings'=>$innings,'day'=>$day);

            $batsmansCount = count($result->query->results->Scorecard->past_ings->d->a->t);
            $batsmans = $result->query->results->Scorecard->past_ings->d->a->t;
            for($i=0;$i<$batsmansCount;$i++) {
               //echo $batsman->name.' '.$batsman->r.'(runs) '.$batsman->b.'(balls) '.$batsman->sr.'(SR) '.$batsman->four.'(fours) '.$batsman->six.'(sixes)<br>';
               $batsman = array("name" => $batsmans[$i]->name,"runs" => $batsmans[$i]->r,"balls" => $batsmans[$i]->b,"sr" => $batsmans[$i]->sr);
               array_push($finalResult,$batsman);
            }      

            return response()->json(array('result'=> $finalResult), 200);
         } else {
            return response()->json(array('result'=> 'empty'), 200);
         }
      } else {
         return view('score',['result' => $result]);
      }
   }
}