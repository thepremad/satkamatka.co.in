<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StarLineGameBid;
use App\Models\StarLineGameName;
use App\Models\StarLineGameResult;
use App\Models\StarLineGameRate;
use App\Models\WalletTransaction;
use App\Models\StarLineWinner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StarLineDeclareResultController extends Controller
{
    function declareResult(Request $request)
    {
        $gameNameList = StarLineGameName::get();
        
        $game_2 = $gameNameList;
        
        $game_3 = StarLineGameName::get();
        
        if(!empty($request->result_date)){
            $date = isset($request->result_date) ? $request->result_date :'';
        }else{
            $date = date('Y-m-d');
        }
        
        foreach($game_3 as $key=>$val){
            
            $check = StarLineGameResult::whereDate('result_at',date('y-m-d'))->where('game_id',$val->id)->count();
            if($check == 0){
    
                unset($game_3[$key]); // Remove the element from the array
    
            }
            
            
            $session_result = $this->GetGameResults($val->id,$date);
            
            $val['open_result'] = $session_result['open'];
            
            $check = StarLineGameResult::whereDate('result_at',date('y-m-d'))->where('game_id',$val->id)->first();
            $val['open_id'] = isset($check->id) ? $check->id :'';
            
            
            
            
            
            
            
        }
        return view('backend.starline-declare-results.index', compact('gameNameList','game_2','date','game_3'));
    }
    
    
    
    function GetGameResults($id,$date){
        // echo $date;die;
		$open_game = StarLineGameResult::whereDate('result_at',$date)->where(['game_id' => $id,'session' => 'open'])->orderby('id','DESC')->first();
		
		
// 		echo $open_game;die;
		
		if(!empty($open_game)){
			$open_sum = self::sumValue($open_game->result_number);
			$open_re = $open_game->result_number;
		}else{
			$open_sum = "*";
			$open_re = "***";
		}

		return ['open' => $open_re.'-'.$open_sum];
    }

    function resultDeclareGameName(Request $request)
    {
        $gameNameList = StarLineGameName::where('status',1)->get();
        return response()->json(['success' => 'data get ', 'data' => $gameNameList]);        
    }

    function resultDeclare(Request $request)
    {
        
        $today = Carbon::now();
        $result_number = $request->result_number;
        $gameResult = new StarLineGameResult();
        $gameResult->result_number = $request->result_number;
        $gameResult->session = 'open';
      
        
        $check_data = StarLineGameResult::whereDate('result_at','=',$request->result_date)->where('game_id',$request->game_id)->count();
        
        // print_r($check_data);die;
        if($check_data > 0){
            return response()->json(['status' => false, 'message' => 'Already Declared']);
        }
         
        
        $gameResult->game_id = $request->game_id;
        $gameResult->result_at = $request->result_date;

        $gameResult->save();
        $toDayOpenResult = StarLineGameResult::whereDate('result_at','=',$today)->first();

        // echo $toDayOpenResult;die;
        $bidingData = StarLineGameBid::whereDate('created_at','=',$today)->where('game_id',$request->game_id)->get();
        
    
        foreach ($bidingData as $data) {
            $bidType = $data->bid_type;
            $game_number = $data->game_number;
            $bidingDataArray = $data->toArray();
            if ($bidType == 'single-digit') {
                $sum = self::sumValue($result_number);
                //check sum is equal to game number or not
                if ($sum == $game_number) {
                    $winner = new StarLineWinner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    $winning_amount =  $this->getWinningAmount($bidType,$data->point_quantity);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            } else if ($bidType == 'single-panna') {
                if ($request->result_number == $game_number) {
                    $winner = new StarLineWinner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    $winning_amount =  $this->getWinningAmount($bidType,$data->point_quantity);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            } else if ($bidType == 'double-panna') {
                if ($request->result_number == $game_number) {
                    $winner = new StarLineWinner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    
                    $winning_amount =  $this->getWinningAmount($bidType,$data->point_quantity);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            } else if ($bidType == 'triple-panna') {
                if ($request->result_number == $game_number) {
                    $winner = new StarLineWinner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    $winning_amount =  $this->getWinningAmount($bidType,$data->point_quantity);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            }
        }
        
        return response()->json(['status' => true, 'message' => 'success']);
    }

    private function sumValue($value)
    {
        $digits = str_split($value);
        $sum = array_sum($digits);
        $stringValue = (string)$sum;
        return substr($stringValue, -1);
    }
    
    function getGameWinningDetails(Request $request){
        $GameName = StarLineGameName::where('id',$request->game_id)->first();
        $sum = self::sumValue($request->option_number);
        // if($request->session == 1){
            $bidingData = StarLineGameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->whereIn('game_number',[$request->option_number,$sum])->get();
        // }elseif($request->session == 2){
            // $bidingData = StarLineGameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->whereIn('game_number',[$request->option_number,$sum])->where('session','close')->get(); 
        // }
        foreach($bidingData as $key=>$val){
                $val['user_name'] = isset(User::where('id',$val->user_id)->first()->name) ? User::where('id',$val->user_id)->first()->name :'';
                $val['user_mobile'] = isset(User::where('id',$val->user_id)->first()->mobile) ? User::where('id',$val->user_id)->first()->mobile :'';
                $val['game_name'] = isset($GameName->name) ? $GameName->name :'';
                $val['open_panna'] = '-';
                $val['open_digit'] = '-';
                $val['winning_amount'] = $this->getWinningAmount($val->bid_type,$val->point_quantity);
                // if($request->session == 1){
                    if($val->game_number == $sum){
                        $val['open_digit'] = $val->game_number;
                    }else{
                        $val['open_panna'] = $val->game_number;
                    }
                // }
            }
        return json_encode($bidingData);
    }
    
    function editBid (Request $request){
        StarLineGameBid::where('id',$request->id)->update(['game_number'=> $request->game_number]);
        return redirect()->back()->with('success','Bid Change Successfully');
    }
    
    function getWinningAmount($type,$point){
        $game_rate = StarLineGameRate::first();
        if($type == 'double-panna'){
            $point_one_amount = $game_rate->double_pana_winning_amount / $game_rate->double_pana_betting_amount;
            return $point * $point_one_amount;
        }
        
        if($type == 'single-panna'){
            $point_one_amount = $game_rate->single_pana_winning_amount / $game_rate->single_pana_betting_amount;
            return $point * $point_one_amount;
        }
        
        if($type == 'jodi-digit'){
            $point_one_amount = $game_rate->jodi_winning_amount / $game_rate->jodi_betting_amount;
            return $point * $point_one_amount;
        }
        
        if($type == 'single-digit'){
            $point_one_amount = $game_rate->single_winning_amount / $game_rate->single_betting_amount;
            return $point * $point_one_amount;
        }
        
        if($type == 'triple-panna'){
            $point_one_amount = $game_rate->tripple_pana_winning_amount / $game_rate->tripple_pana_betting_amount;
            return $point * $point_one_amount;
        }
        
        if($type == 'half-sangam'){
            $point_one_amount = $game_rate->half_sangam_winning_amount / $game_rate->half_sangam_betting_amount;
            return $point * $point_one_amount;
        }
        
        if($type == 'full-sangam'){
            $point_one_amount = $game_rate->full_sangam_winning_amount / $game_rate->full_sangam_betting_amount;
            return $point * $point_one_amount;
        }
    }
    
    function makeWinningAmount($amount,$user_id,$game_id,$winner_id){
        $net_wallet = $this->netWalletAmount($user_id) + $amount;
         WalletTransaction::create(['user_id' => $user_id ,'amount' => $amount ,'game_id' => $game_id,'type' => WalletTransaction::$credit ,'desc' => 'Winning Amount' ,'net_balance' => $net_wallet,'str_winning_id' => $winner_id ]);
    }
    
    function netWalletAmount($user_id){
        $credit = WalletTransaction::where('user_id',$user_id)->where('type',WalletTransaction::$credit)->sum('amount');
        $debit = WalletTransaction::where('user_id',$user_id)->where('type',WalletTransaction::$debit)->sum('amount');
        
        return $credit - $debit;
    }
    
    
    function deleteResult($id){
        
        $game_result = StarLineGameResult::where('id',$id)->first();
        $winner = StarLineWinner::where('game_result_id',$game_result->id)->first();
        if(!empty($winner)){
            WalletTransaction::where('str_winning_id',$winner->id)->delete();    
        }
        $game_result->delete();
        $winner->delete();
        return redirect()->back()->with('success','Delete result successfully');
    }
    
    
}
