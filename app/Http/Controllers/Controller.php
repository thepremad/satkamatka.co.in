<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\GameName;
use App\Models\GameResult;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    
    function calendar($id){
        $new_array = [];
        $get_last_data = GameResult::where('game_id',$id)->get();
        $game_name = GameName::where('id',$id)->first();
        // echo $game_name;die;
        foreach($get_last_data as $key=>$val){
            
            $data = [
                    'session' => $val->session,
                    'date' => $val->result_at,
                    'result_number' => $val->result_number
                ];
            $date = date('Y-m-d', strtotime($val->result_at));
            $new_array[$date][] = $data;
        }
        
        $all_data = [];
        foreach($new_array as $key=>$val){
            $weekNumber = date('W', strtotime($key));
            
            $week_day = date('w', strtotime($key));
            if($week_day == 0){
                $week_day = 7;   
            }
            $close_result = "";
            $open_result = "";
            foreach($val as $k=>$v){
                if($v['session'] == 'close'){
                    $close_result = $v['result_number'];
                }
                if($v['session'] == 'open'){
                    $open_result = $v['result_number'];
                }
            }
            $startDate = date('Y-m-d', strtotime("$key - " . date('N', strtotime($key)) . ' days'));
            $endDate = date('Y-m-d', strtotime("$startDate + 6 days"));
            $all_data[$weekNumber]['start_date'] = $startDate;
            $all_data[$weekNumber]['end_date'] = $endDate;
            
            
            
            
            
            $sum_number_open = '-';
            $sum_number_close = '-';
            if(!empty($open_result)){
                $sum_number_open  = self::sumValue($open_result);    
            }
            if(!empty($close_result)){
                $sum_number_close = self::sumValue($close_result);    
            }
            
            $all_data[$weekNumber]['data'][] = [ 
                'w_number' => $weekNumber,
                'w_day' => $week_day,
                'open_result' => $open_result,
                'close_result' =>$close_result,
                'date' => $key,
                'digit' => $sum_number_open.$sum_number_close,
            ];
        }
        // echo "<pre>";
        
        $calender_data = [];
        foreach($all_data as $key=>$val){
            $new_data = [];
            for($i=1 ; $i<=7 ; $i++){
                $data = [];
                foreach($val['data'] as $k=>$v){
                    if($v['w_day'] == $i){
                        $data = $v;
                        continue;
                    }
                }
                $new_data[] = $data;
            }
            $val['data'] = $new_data;
            $calender_data[] = $val;
        }
        
        // print_r($calender_data);
        // die;
        return view('backend.calender',compact('calender_data','game_name'));
    }
    
    private function sumValue($value)
    {
        $digits = str_split($value);
        $sum = array_sum($digits);
        $stringValue = (string)$sum;
        return substr($stringValue, -1);
    }
    
    
}
