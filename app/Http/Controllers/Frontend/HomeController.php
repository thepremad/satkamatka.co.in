<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSattaMatka;
use App\Models\GameName;
use App\Models\GameResult;
use App\Models\Header;
use App\Models\SattaMatka;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage(){
        $currentDate = Carbon::today()->format('Y-m-d');
        // dd($currentDate);
        $game = GameName::latest()->take(10)->get()->map(function($game_name){
            $game_name['result'] = self::GetGameResults($game_name->id);
            return $game_name;
        });
        $allgame = GameName::get()->map(function($game_name){
            $game_name['result'] = self::GetGameResults($game_name->id);
            return $game_name;
        });
        
        $desc = Header::first();
        $aboutSatta = AboutSattaMatka::get();
        $satta = SattaMatka::get();
        return view('frontend.index',compact('game','allgame','desc','aboutSatta','satta'));
    }

    function GetGameResults($id){
         $currentDateTime = Carbon::now();
         $date = $currentDateTime->toDateString();
         $open_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $id,'session' => 'open'])->orderby('id','DESC')->first();
         $close_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $id,'session' => 'close'])->orderby('id','DESC')->first();
         if(!empty($open_game)){
             $open_sum = self::sumValue($open_game->result_number);
             $open_re = $open_game->result_number;
         }else{
             $open_sum = "*";
             $open_re = "***";
         }
 
         if(!empty($close_game)){
             $close_sum = self::sumValue($close_game->result_number);
             $close_re = $close_game->result_number;
         }else{
             $close_sum = "*";
             $close_re = "***";
         }

         return $open_re.'-'.$open_sum.$close_sum.'-'.$close_re;
    }

    function getResultDigits($id , $date){
        // $currentDateTime = Carbon::now();
        // $date = $currentDateTime->toDateString();
        $open_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $id,'session' => 'open'])->orderby('id','DESC')->first();
        $close_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $id,'session' => 'close'])->orderby('id','DESC')->first();
        if(!empty($open_game)){
            $open_sum = self::sumValue($open_game->result_number);
            $open_re = $open_game->result_number;
        }else{
            $open_sum = "*";
            $open_re = "***";
        }

        if(!empty($close_game)){
            $close_sum = self::sumValue($close_game->result_number);
            $close_re = $close_game->result_number;
        }else{
            $close_sum = "*";
            $close_re = "***";
        }

        // return $open_re.'-'.$open_sum.$close_sum.'-'.$close_re;

        return [
            'open_digit' => $open_re,
            'digit' => $open_sum.$close_sum,
            'close_digit' => $close_re
        ];
   }

     private function sumValue($value)
    {
        $digits = str_split($value);
        $sum = array_sum($digits);
        $stringValue = (string)$sum;
        return substr($stringValue, -1);
    }


    function getDigitResult($game_id,$date){
        $open_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $game_id,'session' => 'open'])->first();
        $close_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $game_id,'session' => 'close'])->first();

        if(!empty($open_game)){
            $open = self::sumValue($open_game->result_number);
        }else{
            $open = '*';
        }
        if(!empty($close_game)){
            $close = self::sumValue($close_game->result_number);
        }else{
            $close = '*';
        }
        return $open.$close;
        
    }


    public function jodi($id){
        $new_array = [];
        
        $last_date = GameResult::orderBy('id','ASC')->first();
        $start_date = Carbon::parse('2024-01-01'); // Replace '2024-01-01' with your actual start date
        $current_date = Carbon::now();

        $data = [];
        while ($start_date->lessThanOrEqualTo($current_date)) {
            $digit = $this->getDigitResult($id,$start_date->toDateString());
            $data[] = ['date' => $start_date->toDateString() ,'digit' => $digit ,'day' => date('D',strtotime($start_date->toDateString()))];
            $start_date->addDay(); // Increment by one day
        }

        // echo "<pre>";
        // print_r($data);die;

        $game = GameName::find($id);
        $game['result'] = self::GetGameResults($id);
        return view('frontend.calender',compact('data','game'));
    }

    function panel($id){
        $game = GameName::find($id);
        $new_array = [];

        $game = GameName::find($id);
        $new_array = [];

        // Get the first game result
        $last_date = GameResult::orderBy('id', 'ASC')->first();
        $start_date = Carbon::parse($last_date->result_at);
        $current_date = Carbon::now();

        $data = [];
        $week_data = [];
        $week_start_date = $start_date->copy()->startOfWeek();

        while ($week_start_date->lessThanOrEqualTo($current_date)) {
            $data = [];
            $end_of_week = $week_start_date->copy()->endOfWeek();

            while ($start_date->lessThanOrEqualTo($end_of_week) && $start_date->lessThanOrEqualTo($current_date)) {
                $digit = $this->getResultDigits($id , $start_date->toDateString());

                // print_r($digit);die;
                // echo $digit;die;
                $data[] = ['date' => $start_date->toDateString(), 'open_panna' => $digit['open_digit'] ?? '' , 'close_panna' => $digit['close_digit'] ?? '' , 'digit' => $digit['digit'] ?? ''];
                $start_date->addDay();
            }

            $week_data[$week_start_date->toDateString()] = $data;
            $week_start_date->addWeek();
        }

        // Add the last week's data if there's any
        if (!empty($data)) {
            $week_data[$week_start_date->toDateString()] = $data;
        }

        // echo "<pre>";
        // print_r($week_data);die;
        return view('frontend.panel',compact('game','week_data'));
    }


    // private function sumValue($value)
    // {
    //     $digits = str_split($value);
    //     $sum = array_sum($digits);
    //     $stringValue = (string)$sum;
    //     return substr($stringValue, -1);
    // }
    // public function panel($id){
    //     $new_array = [];
    //     $get_last_data = DeclareGame::where('game_id',$id)->get();
    //     $game_name = Game::where('id',$id)->first();
    //     foreach($get_last_data as $key=>$val){
            
    //         $data = [
    //                 'session' => $val->session,
    //                 'date' => $val->date,
    //                 'result_number' => $val->panna
    //             ];
    //         $date = date('Y-m-d', strtotime($val->date));
    //         $new_array[$date][] = $data;
    //     }
    //     $all_data = [];

    //     foreach($new_array as $key=>$val){
    //         $weekNumber = date('W', strtotime($key));
            
    //         $week_day = date('w', strtotime($key));
    //         if($week_day == 0){
    //             $week_day = 7;   
    //         }
    //         $close_result = "";
    //         $open_result = "";
    //         foreach($val as $k=>$v){
    //             if($v['session'] == '2'){
    //                 $close_result = $v['result_number'];
    //             }
    //             if($v['session'] == '1'){
    //                 $open_result = $v['result_number'];
    //             }
    //         }
    //         $startDate = date('Y-m-d', strtotime("$key - " . date('N', strtotime($key)) . ' days'));
    //         $endDate = date('Y-m-d', strtotime("$startDate + 6 days"));
    //         $all_data[$weekNumber]['start_date'] = $startDate;
    //         $all_data[$weekNumber]['end_date'] = $endDate;
            
            
            
            
            
    //         $sum_number_open = '-';
    //         $sum_number_close = '-';
    //         if(!empty($open_result)){
    //             $sum_number_open  = self::sumValue($open_result);    
    //         }
    //         if(!empty($close_result)){
    //             $sum_number_close = self::sumValue($close_result);    
    //         }
            
    //         $all_data[$weekNumber]['data'][] = [ 
    //             'w_number' => $weekNumber,
    //             'w_day' => $week_day,
    //             'open_result' => $open_result,
    //             'close_result' =>$close_result,
    //             'date' => $key,
    //             'digit' => $sum_number_open.$sum_number_close,
    //         ];
    //     }
    //     // echo "<pre>";
        
    //     $calender_data = [];
    //     foreach($all_data as $key=>$val){
    //         $new_data = [];
    //         for($i=1 ; $i<=7 ; $i++){
    //             $data = [];
    //             foreach($val['data'] as $k=>$v){
    //                 if($v['w_day'] == $i){
    //                     $data = $v;
    //                     continue;
    //                 }
    //             }
    //             $new_data[] = $data;
    //         }
    //         $val['data'] = $new_data;
    //         $calender_data[] = $val;
    //     }
        
        
    //     return view('frontend.panel',compact('calender_data','game_name'));
    // }
}
