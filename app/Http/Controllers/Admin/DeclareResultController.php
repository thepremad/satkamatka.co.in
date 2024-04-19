<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameBid;
use App\Models\GameName;
use App\Models\GameResult;
use App\Models\GameRate;
use App\Models\WalletTransaction;
use App\Models\Winner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeclareResultController extends Controller
{
    function declareResult(Request $request)
    {
        
        if(!empty($request->result_date)){
            $date = isset($request->result_date) ? $request->result_date :'';
        }else{
            $date = date('Y-m-d');
        }
        
         if(!empty($request->result_date_filter)){
            $result_date_filter = isset($request->result_date_filter) ? $request->result_date_filter :'';
        }else{
            $result_date_filter = date('Y-m-d');
        }
        
        $gameNameList = GameName::get();
        
        foreach($gameNameList as $key=>$val){
            $check = GameResult::whereDate('result_at',$date)->where('session','close')->where('game_id',$val->id)->count();
            if($check > 0){
                 unset($gameNameList[$key]); // Remove the element from the array
            }
        }
        
        $game_2 = $gameNameList;
        
        $game_3 = GameName::get();
        
        
        
        foreach($game_3 as $key=>$val){
            $session_result = $this->GetGameResults($val->id,$result_date_filter);
            $val['open_result'] = $session_result['open'];
            $val['close_result'] = $session_result['close'];
            $val['close_id'] = $session_result['close_id'];
            $val['open_id'] = $session_result['open_id'];
            
            $check = GameResult::whereDate('result_at',$result_date_filter)->where('game_id',$val->id)->count();
            if($check == 0){
    
                unset($game_3[$key]); // Remove the element from the array
    
            }
            
        }
        return view('backend.declare-results.index', compact('gameNameList','game_2','date','game_3'));
    }
    
    
    
    function GetGameResults($id,$date){
        // echo $date;die;
		$open_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $id,'session' => 'open'])->orderby('id','DESC')->first();
		$close_game = GameResult::whereDate('result_at',$date)->where(['game_id' => $id,'session' => 'close'])->orderby('id','DESC')->first();
		
// 		echo $open_game;die;
		
		if(!empty($open_game)){
			$open_sum = self::sumValue($open_game->result_number);
			$open_re = $open_game->result_number;
			$open_id = $open_game->id;
		}else{
			$open_sum = "*";
			$open_re = "***";
			$open_id = 0;
		}

		if(!empty($close_game)){
			$close_sum = self::sumValue($close_game->result_number);
			$close_re = $close_game->result_number;
			$close_id = $close_game->id;
		}else{
			$close_sum = "*";
			$close_re = "***";
			$close_id = 0;
		}
		
		return ['open' => $open_re.'-'.$open_sum ,'close' => $close_re.'-'.$close_sum ,'open_id' => $open_id ,'close_id' => $close_id];
    }

    function resultDeclareGameName(Request $request)
    {
        $gameNameList = GameName::where('status',1)->get();
        return response()->json(['success' => 'data get ', 'data' => $gameNameList]);        
    }

    function resultDeclare(Request $request)
    {
        
        // $today = Carbon::now();
        $today = Carbon::parse($request->result_date);
        
        
        $result_number = $request->result_number;
        $gameResult = new GameResult();
        $gameResult->result_number = $request->result_number;
        if($request->session == 1){
            $gameResult->session = 'open';
        }else{
            $gameResult->session = 'close';
            $check_data = GameResult::whereDate('result_at','=',$request->result_date)->where('session', 'open')->where('game_id',$request->game_id)->count();
            if($check_data == 0){
                return response()->json(['status' => false, 'message' => 'Please Declare open session ']);
            }
        }
        
        $check_data = GameResult::whereDate('result_at','=',$request->result_date)->where('session', $gameResult->session)->where('game_id',$request->game_id)->count();
        
        // print_r($check_data);die;
        if($check_data > 0){
            return response()->json(['status' => false, 'message' => 'Already Declared']);
        }
         
        
        $gameResult->game_id = $request->game_id;
        $gameResult->result_at = $request->result_date;

        $gameResult->save();
        $toDayOpenResult = GameResult::whereDate('result_at','=',$today)->where('game_id',$request->game_id)->where('session', 'open')->first();

        // echo $toDayOpenResult;die;
        $bidingData = GameBid::whereDate('created_at','=',$today)->where('game_id',$request->game_id);
        if($gameResult->session == 'open'){
            $bidingData->where('session','open');
        }else{
            $bidingData->where('session','close');
        }
        
        $bidingData = $bidingData->get();
        
    
        foreach ($bidingData as $data) {
            $bidType = $data->bid_type;
            $game_number = $data->game_number;
            $bidingDataArray = $data->toArray();
            
            if($bidType == '2-digit-panel' || $bidType == 'sp-dp-tp' || $bidType == 'panel-group'){
                $single_panna = config('constants.single-pana');
                $doubal_panna = config('constants.double-pana');
                $tripple_panna = config('constants.tripple-pana');
                foreach($single_panna as $key){
                    if($key == $game_number){
                         $bidType = 'single-panna';
                    } 
                }
                foreach($doubal_panna as $key){
                   if($key == $game_number){
                         $bidType = 'double-panna';
                    } 
                }
                foreach($tripple_panna as $key){
                    if($key == $game_number){
                         $bidType = 'triple-panna';
                    } 
                }
            }
        
        
            if ($bidType == 'single-digit') {
                $sum = self::sumValue($result_number);
                //check sum is equal to game number or not
                if ($sum == $game_number) {
                    $winner = new Winner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    $winning_amount =  $this->getWinningAmount($data->id);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            } else if ($bidType == 'jodi-digit') {
                if ($request->session == 2) {
                    $toDayOpenResultNumber = $toDayOpenResult->result_number;
                    $toDayOpenResultValue = self::sumValue($toDayOpenResultNumber);
                    $toDayCloseResultValue = self::sumValue($result_number);
                    $jodiDigit = $toDayOpenResultValue . $toDayCloseResultValue;
                    if ($jodiDigit == $data->game_number) {
                        $winner = new Winner();
                        $winner->fill($bidingDataArray);
                        $winner->game_result_id = $gameResult->id;
                        $winner->bid_id = $data->id;
                        $winner->winning_at = Carbon::now();
                        $winning_amount =  $this->getWinningAmount($data->id);
                        $winner->winning_amount = $winning_amount;
                        $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                        $winner->save();
                        $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                    }
                }
            } else if ($bidType == 'single-panna') {
                if ($request->result_number == $game_number) {
                    $winner = new Winner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    $winning_amount =  $this->getWinningAmount($data->id);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            } else if ($bidType == 'double-panna') {
                if ($request->result_number == $game_number) {
                    $winner = new Winner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    
                    $winning_amount =  $this->getWinningAmount($data->id);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            } else if ($bidType == 'triple-panna') {
                if ($request->result_number == $game_number) {
                    $winner = new Winner();
                    $winner->fill($bidingDataArray);
                    $winner->game_result_id = $gameResult->id;
                    $winner->bid_id = $data->id;
                    $winner->winning_at = Carbon::now();
                    $winning_amount =  $this->getWinningAmount($data->id);
                    $winner->winning_amount = $winning_amount;
                    $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                    $winner->save();
                    $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                }
            } else if ($bidType == 'half-sangam') {
                if ($request->session == 2) {
                    $toDayOpenResultNumber = $toDayOpenResult->result_number;
                    $toDayOpenResultValue = self::sumValue($toDayOpenResultNumber);
                    $toDayCloseResultValue = $result_number;
                    if ($toDayOpenResultValue == $data->game_number && $toDayCloseResultValue == $data->game_number_sangam_close) {
                        $winner = new Winner(); 
                        $winner->fill($bidingDataArray);
                        $winner->game_result_id = $gameResult->id;
                        $winner->bid_id = $data->id;
                        $winner->winning_at = Carbon::now();
                        $winning_amount =  $this->getWinningAmount($data->id);
                        $winner->winning_amount = $winning_amount; 
                        $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                        $winner->save();
                        
                        $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                    }
                }
            } else if ($bidType == 'full-sangam') {
                if ($request->session == 2) {
                    $toDayOpenResultNumber = $toDayOpenResult->result_number;
                    $toDayOpenResultValue = $toDayOpenResultNumber;
                    $toDayCloseResultValue = $result_number;
                    if ($toDayOpenResultValue == $data->game_number && $toDayCloseResultValue == $data->game_number_sangam_close) {
                        $winner = new Winner(); 
                        $winner->fill($bidingDataArray);
                        $winner->game_result_id = $gameResult->id;
                        $winner->bid_id = $data->id;
                        $winner->winning_at = Carbon::now();
                        $winning_amount =  $this->getWinningAmount($data->id);
                        $winner->winning_amount = $winning_amount;
                        $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                        $winner->save();
                        $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                    }
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
        $desclare_result_date = $request->desclare_result_date;
        $GameName = GameName::where('id',$request->game_id)->first();
        $sum = self::sumValue($request->option_number);
        
        $session = isset($request->session) ? $request->session : 1;
        
        if($session == 1){
            $digitAndPanna = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->whereIn('game_number',[$request->option_number,$sum])->where('session','open')->get();
            $halfSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$sum)->where('bid_type','half-sangam')->get();
            $fullSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$request->option_number)->where('bid_type','full-sangam')->get();
            $bidingData = $digitAndPanna->concat($halfSangam)->concat($fullSangam);
        }elseif($session == 2){
            $toDayOpenResult = GameResult::whereDate('result_at', '=', $desclare_result_date)->where('game_id', $request->game_id)->where('session', 'open')->first();
            if(!$toDayOpenResult){
                return json_encode(['status' => false,'message' => 'Sorry! Open result not declare please first declare open result']);               
            }
            
            $toDayOpenResultCalculate = self::sumValue($toDayOpenResult->result_number);
            $digitAndPanna = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->whereIn('game_number',[$request->option_number,$sum])->where('session','close')->whereNotIn('bid_type',['half-sangam','full-sangam'])->get(); 
            $jodiDigit = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$toDayOpenResultCalculate.$sum)->where('bid_type','jodi-digit')->get(); 
            $halfSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$toDayOpenResultCalculate)->where('game_number_sangam_close',$request->option_number)->where('bid_type','half-sangam')->get();
            $fullSangam = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->where('game_number',$toDayOpenResult->result_number)->where('game_number_sangam_close',$request->option_number)->where('bid_type','full-sangam')->get();
            $bidingData = $digitAndPanna->concat($jodiDigit)->concat($halfSangam)->concat($fullSangam);
        }
        // $bidingData = GameBid::whereDate('created_at','=',$request->desclare_result_date)->where('game_id',$request->game_id)->whereIn('game_number',[$request->option_number,$sum])->where('bid_type','half-sangam')->get();
        
        $uniqueData = [];
        $idSet = [];
        foreach($bidingData as $key=>$val){
            
                $val['user_name'] = isset(User::where('id',$val->user_id)->first()->name) ? User::where('id',$val->user_id)->first()->name :'';
                $val['user_mobile'] = isset(User::where('id',$val->user_id)->first()->mobile) ? User::where('id',$val->user_id)->first()->mobile :'';
                $val['game_name'] = isset($GameName->name) ? $GameName->name :'';
                $val['open_panna'] = '-';
                $val['open_digit'] = '-';
                $val['close_panna'] = '-';
                $val['close_digit'] = '-';
                $val['winning_amount'] = $this->getWinningAmount($val->id);
                
                if($request->session == 1){
                    if($val->game_number == $sum){
                        $val['open_digit'] = $val->game_number;
                    }else{
                        $val['open_panna'] = $val->game_number;
                    }
                    // if($val['bid_type' == 'half-sangam']){
                        // if($val->game_number == $request->option_number){
                            $val['close_panna'] = $val->game_number_sangam_close;
                        // }   
                    // }
                }
                if($request->session == 2){
                    
                    if($val->game_number != $sum){
                        $val['close_panna'] = $val->game_number;
                    }else{
                        if($val['bid_type'] == 'jodi-digit'){
                            $val['open_digit'] = $sum;
                        }else{
                        $val['close_digit'] = $val->game_number;
                        }
                    }
                }
                
                if($val['bid_type'] == 'half-sangam'){
                    $val['open_panna'] = '-';
                    $val['open_digit'] = $val->game_number;
                    $val['close_panna'] = $val->game_number_sangam_close;
                    $val['close_digit'] = '-';   
                }
                
                if($val['bid_type'] == 'full-sangam'){
                    $val['open_panna'] = $val->game_number;
                    $val['open_digit'] = '-';   
                    $val['close_panna'] = $val->game_number_sangam_close;
                    $val['close_digit'] = '-';   
                }
                
                if($val['bid_type'] == 'triple-panna'){
                    if($request->session == 1){
                        $val['open_panna'] = $val->game_number;
                        $val['open_digit'] = '-';   
                        $val['close_panna'] = '-';
                        $val['close_digit'] = '-';       
                    }else{
                        $val['open_panna'] = '';
                        $val['open_digit'] = '-';   
                        $val['close_panna'] = $val->game_number;;
                        $val['close_digit'] = '-';   
                    }
                    
                }
                
                if($val['bid_type'] == 'jodi-digit'){
                    $input_string = $val->game_number;
                    if (strlen($input_string) == 2 && $input_string[0] == "0" && $input_string[1] == "0") {
                        $first_zero = $input_string[0];
                        $second_zero = $input_string[1];
                    }
                    
                    $val['open_panna'] = '-';   
                    $val['open_digit'] = $first_zero;
                    $val['close_panna'] = '-';   
                    $val['close_digit'] = $second_zero;
                }
                
                $id = $val->id;
                if (!in_array($id, $idSet)) {
                    $idSet[] = $id; // Add the id to the set
                    $uniqueData[] = $val; // Add the value to the unique data array
                }  
                
            }
        return json_encode(['status' => true,'data' =>$uniqueData]);               
    }
    
    function editBid (Request $request){
        GameBid::where('id',$request->id)->update(['game_number'=> $request->game_number]);
        return redirect()->back()->with('success','Bid Change Successfully');
    }
    
    function getWinningAmount($bid_id){
        $bid_detail = GameBid::find($bid_id);
        $type = $bid_detail->bid_type;
        $number = $bid_detail->game_number;
        $point = $bid_detail->point_quantity;
        $game_rate = GameRate::first();
        
        if($type == '2-digit-panel' || $type == 'sp-dp-tp' || $type == 'panel-group'){
            $single_panna = config('constants.single-pana');
            $doubal_panna = config('constants.double-pana');
            $tripple_panna = config('constants.tripple-pana');
            foreach($single_panna as $key){
                if($key == $number){
                     $type = 'single-panna';
                } 
            }
            foreach($doubal_panna as $key){
               if($key == $number){
                     $type = 'double-panna';
                } 
            }
            foreach($tripple_panna as $key){
                if($key == $number){
                     $type = 'triple-panna';
                } 
            }
        }
        
        
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
         WalletTransaction::create(['user_id' => $user_id ,'amount' => $amount ,'game_id' => $game_id,'type' => WalletTransaction::$credit ,'desc' => 'Winning Amount' ,'net_balance' => $net_wallet ,'winning_id' => $winner_id]);
    }
    
    function netWalletAmount($user_id){
        $credit = WalletTransaction::where('user_id',$user_id)->where('type',WalletTransaction::$credit)->sum('amount');
        $debit = WalletTransaction::where('user_id',$user_id)->where('type',WalletTransaction::$debit)->sum('amount');
        return $credit - $debit;
    }
    
    function deleteResult ($id){
        
        $game_result = GameResult::where('id',$id)->first();
        $winner = Winner::where('game_result_id',$game_result->id)->pluck('id')->toArray();
        if(!empty($winner)){
            WalletTransaction::whereIn('winning_id',$winner)->delete();    
            Winner::whereIn('id',$winner)->delete();
        }
        $game_result->delete();
        return redirect()->back()->with('success','Delete result successfully');
    }
    
    
    function declareResultSave(Request $request){
         try {
            DB::beginTransaction();
            $result_date = $request->desclare_result_date;
            $session = $request->desclare_result_session;
            $number = $request->open_number;
            $game_id = $request->desclare_result_game_name;
            
            
            if($session == '1'){
                $session = 'open';
            }else{
                $session = 'close';
            }
            $game_Result = GameResult::whereDate('result_at',$request->result_date)->where('game_id',$request->game_id)->where('session',$session)->count();
            if($game_Result > 0){
                return redirect()->back()->with('error','Game is already declared');
            }
            
            
            $today = $request->result_date;
            
            $gameResult = new GameResult();
            $gameResult->result_number = $number;
            $gameResult->game_id = $game_id;
            $gameResult->result_at = $result_date;
            $gameResult->session = $session;
            $gameResult->save();
            
            $bidingData = GameBid::whereDate('created_at','=',$result_date)->where('game_id',$game_id);
            if($gameResult->session == 'open'){
                $bidingData->where('session','open');
            }else{
                $check_data = GameResult::whereDate('result_at',$result_date)->where('session', 'open')->where('game_id',$game_id)->count();
                if($check_data == 0){
                    return response()->json(['status' => false, 'message' => 'Please Declare open session ']);
                }
                $bidingData->where('session','close');
                $toDayOpenResult = GameResult::whereDate('result_at',$result_date)->where('game_id', $game_id)->where('session', 'open')->first();
            }
            
            $bidingData = $bidingData->get();
            
            $result_number = $number;
            $single_panna = config('constants.single-pana');
            $doubal_panna = config('constants.double-pana');
            $tripple_panna = config('constants.tripple-pana');
            
            foreach ($bidingData as $data) {
                $bidType = $data->bid_type;
                $game_number = $data->game_number;
                $bidingDataArray = $data->toArray();
                
                
                
                if($bidType == '2-digit-panel' || $bidType == 'sp-dp-tp' || $bidType == 'panel-group'){
                    
                    foreach($single_panna as $key){
                        if($key == $game_number){
                             $bidType = 'single-panna';
                        }
                    }
                    foreach($doubal_panna as $key){
                      if($key == $game_number){
                             $bidType = 'double-panna';
                        }
                    }
                    foreach($tripple_panna as $key){
                        if($key == $game_number){
                             $bidType = 'triple-panna';
                        }
                    }
                }
                
                if ($bidType == 'single-digit') {
                    $sum = self::sumValue($result_number);
                    //check sum is equal to game number or not
                    if ($sum == $game_number) {
                        $winner = new Winner();
                        $winner->fill($bidingDataArray);
                        $winner->game_result_id = $gameResult->id;
                        $winner->bid_id = $data->id;
                        $winner->winning_at = Carbon::now();
                        $winning_amount =  $this->getWinningAmount($data->id);
                        $winner->winning_amount = $winning_amount;
                        $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                        $winner->save();
                        $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                    }
                } else if ($bidType == 'jodi-digit') {
                    if ($session == 'close') {
                        $toDayOpenResultNumber = $toDayOpenResult->result_number;
                        $toDayOpenResultValue = self::sumValue($toDayOpenResultNumber);
                        $toDayCloseResultValue = self::sumValue($result_number);
                        $jodiDigit = $toDayOpenResultValue . $toDayCloseResultValue;
                        
                        if ($jodiDigit == $data->game_number) {
                            $winner = new Winner();
                            $winner->fill($bidingDataArray);
                            $winner->game_result_id = $gameResult->id;
                            $winner->bid_id = $data->id;
                            $winner->winning_at = Carbon::now();
                            $winning_amount =  $this->getWinningAmount($data->id);
                            $winner->winning_amount = $winning_amount;
                            $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                            $winner->save();
                            $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                        }
                    }
                } else if ($bidType == 'single-panna') {
                    if ($result_number == $game_number) {
                        $winner = new Winner();
                        $winner->fill($bidingDataArray);
                        $winner->game_result_id = $gameResult->id;
                        $winner->bid_id = $data->id;
                        $winner->winning_at = Carbon::now();
                        $winning_amount =  $this->getWinningAmount($data->id);
                        $winner->winning_amount = $winning_amount;
                        $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                        $winner->save();
                        $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                    }
                } else if ($bidType == 'double-panna') {
                    if ($result_number == $game_number) {
                        $winner = new Winner();
                        $winner->fill($bidingDataArray);
                        $winner->game_result_id = $gameResult->id;
                        $winner->bid_id = $data->id;
                        $winner->winning_at = Carbon::now();
                        
                        $winning_amount =  $this->getWinningAmount($data->id);
                        $winner->winning_amount = $winning_amount;
                        $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                        $winner->save();
                        
                        $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                    }
                } else if ($bidType == 'triple-panna') {
                    if ($result_number == $game_number) {
                        $winner = new Winner();
                        $winner->fill($bidingDataArray);
                        $winner->game_result_id = $gameResult->id;
                        $winner->bid_id = $data->id;
                        $winner->winning_at = Carbon::now();
                        $winning_amount =  $this->getWinningAmount($data->id);
                        $winner->winning_amount = $winning_amount;
                        $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                        $winner->save();
                        $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                    }
                } else if ($bidType == 'half-sangam') {
                    if ($session == 'close') {
                        $toDayOpenResultNumber = $toDayOpenResult->result_number;
                        $toDayOpenResultValue = self::sumValue($toDayOpenResultNumber);
                        $toDayCloseResultValue = $result_number;
                        if ($toDayOpenResultValue == $data->game_number && $toDayCloseResultValue == $data->game_number_sangam_close) {
                            $winner = new Winner(); 
                            $winner->fill($bidingDataArray);
                            $winner->game_result_id = $gameResult->id;
                            $winner->bid_id = $data->id;
                            $winner->winning_at = Carbon::now();
                            $winning_amount =  $this->getWinningAmount($data->id);
                            $winner->winning_amount = $winning_amount; 
                            $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                            $winner->save();
                            
                            $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                        }
                    }
                } else if ($bidType == 'full-sangam') {
                    if ($session == 'close') {
                        $toDayOpenResultNumber = $toDayOpenResult->result_number;
                        $toDayOpenResultValue = $toDayOpenResultNumber;
                        $toDayCloseResultValue = $result_number;
                        if ($toDayOpenResultValue == $data->game_number && $toDayCloseResultValue == $data->game_number_sangam_close) {
                            $winner = new Winner(); 
                            $winner->fill($bidingDataArray);
                            $winner->game_result_id = $gameResult->id;
                            $winner->bid_id = $data->id;
                            $winner->winning_at = Carbon::now();
                            $winning_amount =  $this->getWinningAmount($data->id);
                            $winner->winning_amount = $winning_amount;
                            $winner->net_balance = $this->netWalletAmount($data->user_id) + $winning_amount;
                            $winner->save();
                            $this->makeWinningAmount($winning_amount,$data->user_id,$request->game_id,$winner->id);
                        }
                    }
                }
            }
            
            DB::commit();
            return redirect()->back()->with('success','Game Declare successfully');
        }catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
    
    
    function check_is_declare_or_not(Request $request){
       
            if($request->session == 1){
                $session = 'open';
            }else{
                $session = 'close';
            }
            $game_Result = GameResult::whereDate('result_at',$request->result_date)->where('game_id',$request->game_id)->where('session',$session)->count();
            return $game_Result;
            
            
            
        
    }
    
    
}
