<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameName;
use Illuminate\Http\Request;

class WinningPredictionController extends Controller
{
    function winningPrediction(Request $request)
    {
        $gameNameList = GameName::pluck('name','id');
        return view('backend.winning-predictions.index',compact('gameNameList'));
    }
    
    
    // function getGameWinningDetails($data){
    //     $GameName = GameName::where('id',$request->game_id)->first();
    //     $sum = self::sumValue($request->option_number);
    //     if($request->session == 1){
    //         $digitAndPanna = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->whereIn('game_number',[$request->option_number,$sum])->where('session','open')->get();
    //         $halfSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$sum)->where('bid_type','half-sangam')->get();
    //         $fullSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$request->option_number)->where('bid_type','full-sangam')->get();
    //         $bidingData = $digitAndPanna->concat($halfSangam)->concat($fullSangam);
    //     }elseif($request->session == 2){
    //         $toDayOpenResult = GameResult::whereDate('result_at', '=', date('Y-m-d'))->where('game_id', $request->game_id)->where('session', 'open')->first();
    //         if(!$toDayOpenResult){
    //             return json_encode(['status' => false,'message' => 'Sorry! Open result not declare please first declare open result']);               
    //         }
            
    //         $toDayOpenResultCalculate = self::sumValue($toDayOpenResult->result_number);
    //         $digitAndPanna = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->whereIn('game_number',[$request->option_number,$sum])->where('session','close')->get(); 
    //         $jodiDigit = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$toDayOpenResultCalculate.$sum)->where('bid_type','jodi-digit')->get(); 
    //         $halfSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$toDayOpenResultCalculate)->where('game_number_sangam_close',$request->option_number)->where('bid_type','half-sangam')->get();
    //         $fullSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$toDayOpenResult->result_number)->where('game_number_sangam_close',$request->option_number)->where('bid_type','full-sangam')->get();
    //         $bidingData = $digitAndPanna->concat($jodiDigit)->concat($halfSangam)->concat($fullSangam);
    //     }
    //     $uniqueData = [];
    //     $idSet = [];
    //     foreach($bidingData as $key=>$val){
            
    //             $val['user_name'] = isset(User::where('id',$val->user_id)->first()->name) ? User::where('id',$val->user_id)->first()->name :'';
    //             $val['user_mobile'] = isset(User::where('id',$val->user_id)->first()->mobile) ? User::where('id',$val->user_id)->first()->mobile :'';
    //             $val['game_name'] = isset($GameName->name) ? $GameName->name :'';
    //             $val['open_panna'] = '-';
    //             $val['open_digit'] = '-';
    //             $val['close_panna'] = '-';
    //             $val['close_digit'] = '-';
    //             $val['winning_amount'] = $this->getWinningAmount($val->id);
                
    //             if($request->session == 1){
    //                 if($val->game_number == $sum){
    //                     $val['open_digit'] = $val->game_number;
    //                 }else{
    //                     $val['open_panna'] = $val->game_number;
    //                 }
    //             }
    //             if($request->session == 2){
                    
    //                 if($val->game_number != $sum){
    //                     $val['close_panna'] = $val->game_number;
    //                 }else{
    //                     if($val['bid_type'] == 'jodi-digit'){
    //                         $val['open_digit'] = $sum;
    //                     }else{
    //                     $val['close_digit'] = $val->game_number;
    //                     }
    //                 }
    //             }
                
    //             if($val['bid_type'] == 'half-sangam'){
    //                 $val['open_panna'] = '-';
    //                 $val['open_digit'] = $val->game_number;
    //                 $val['close_panna'] = $val->game_number_sangam_close;
    //                 $val['close_digit'] = '-';   
    //             }
                
    //             if($val['bid_type'] == 'full-sangam'){
    //                 $val['open_panna'] = $val->game_number;
    //                 $val['open_digit'] = '-';   
    //                 $val['close_panna'] = $val->game_number_sangam_close;
    //                 $val['close_digit'] = '-';   
    //             }
                
    //             if($val['bid_type'] == 'jodi-digit'){
    //                 $input_string = $val->game_number;
    //                 if (strlen($input_string) == 2 && $input_string[0] == "0" && $input_string[1] == "0") {
    //                     $first_zero = $input_string[0];
    //                     $second_zero = $input_string[1];
    //                 }
                    
    //                 $val['open_panna'] = '-';   
    //                 $val['open_digit'] = $first_zero;
    //                 $val['close_panna'] = '-';   
    //                 $val['close_digit'] = $second_zero;
    //             }
                
    //             $id = $val->id;
    //             if (!in_array($id, $idSet)) {
    //                 $idSet[] = $id; // Add the id to the set
    //                 $uniqueData[] = $val; // Add the value to the unique data array
    //             }  
                
    //         }
    //     return json_encode(['status' => true,'data' =>$uniqueData]);               
    // }
}
