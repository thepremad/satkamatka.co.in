<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserProfileCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\StarLineGameResource;
use App\Models\StarLineGameBid;
use App\Models\User;
use App\Models\StarLineGameName;
use App\Models\StarLineWinner;
use App\Models\StarLineGameResult;
use App\Models\MoneyRequest;
use App\Models\WalletTransaction;
use App\Models\BankDetail;
use App\Models\MainSetting;
use App\Models\ValueMaster;
use App\Models\ContactSetting;
use App\Traits\ResponseWithHttpRequest;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class StarLineGameNameController extends Controller
{
    use ResponseWithHttpRequest;
    function getAllGame(Request $request){
        
        
        $data = StarLineGameName::orderBy('today_open_time', 'asc')->get();
		foreach($data as $key=>$val){
			$val['result'] = $this->GetGameResults($val->id);
		}
		$user_data = User::where('id',$request->user_id)->first();
		if($user_data->status == '1'){
			    $status = 'Active';
			}else{
			    $status = 'Inactive';
			}
		$user_data['status'] = $status;
        return $this->sendSuccess('GAME NAME SUCCESSFULLY', ['game' =>  StarLineGameResource::collection($data) ,'user_detail' => new UserProfileCollection($user_data)]);
    }

	function GetGameResults($id){
		$open_game = StarLineGameResult::whereDate('result_at',date('Y-m-d'))->where(['game_id' => $id,'session' => 'open'])->orderby('id','DESC')->first();
		if(!empty($open_game)){
			$open_sum = self::sumValue($open_game->result_number);
			$open_re = $open_game->result_number;
		}else{
			$open_sum = "*";
			$open_re = "***";
		}

	
		
		return $open_re.'-'.$open_sum;
	}

	private function sumValue($value)
    {
        $digits = str_split($value);
        $sum = array_sum($digits);
        $stringValue = (string)$sum;
        return substr($stringValue, -1);
    }
    
    public function createBid(Request $request)
    {
        $jsonData = $request->json()->all();
        $bids = $jsonData;

        $validator = Validator::make(['bids' => $bids], [
            'bids' => 'required|array',
            'bids.*.game_id' => 'required|integer|exists:game_names,id',
            'bids.*.user_id' => 'required|integer|exists:users,id',
            'bids.*.bid_type' => 'required|string',
            'bids.*.game_number' => 'required|integer',
            'bids.*.point_quantity' => 'required|integer',
            'bids.*.session' => 'required|in:open',
        ]);

        if ($validator->fails()) {
            return $this->sendFailed($validator->errors()->first(), 201);
        }

        $user_id = $bids[0]['user_id'];
        $balance = WalletTransaction::query()
            ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
            ->where('user_id', $user_id)
            ->first();
        $actual_amount = $balance->balance ?? 0;

        $totalBidPoints = 0;

        foreach ($bids as $bid) {
            $game_number = $bid['game_number'];
            $point_quantity = $bid['point_quantity'];
            $session = $bid['session'];

            // Calculate the total bid points
            $totalBidPoints += $point_quantity;
        }

        if ($actual_amount >= $totalBidPoints) {
            foreach ($bids as $bid) {
                $game_number = $bid['game_number'];
                $point_quantity = $bid['point_quantity'];
                $session = $bid['session'];

                // Proceed with creating the bids and wallet transactions as before
                $gameBid = StarLineGameBid::create([
                    'game_id' => $bid['game_id'],
                    'user_id' => $bid['user_id'],
                    'bid_type' => $bid['bid_type'],
                    'game_number' => $game_number,
                    'point_quantity' => $point_quantity,
                    'session' => $session
                ]);

                WalletTransaction::create([
                    'user_id' => $bid['user_id'],
                    'amount' => $point_quantity,
                    'type' => WalletTransaction::$debit,
                    'game_id' => $bid['game_id'],
                    'net_balance' => $actual_amount - $point_quantity
                ]);
            }

            return $this->sendSuccess('BID CREATE SUCCESSFULLY');
        }

        return $this->sendFailed('INSUFFICIENT BALANCE', 200);
    }
    
    
	
		function getGameNumber(Request $request){
	    
	    if($request->type =='single-digit'){
	        $digit = config('constants.single-digit');
	        // Transform the array to the desired format
            $formattedData = [];
            foreach ($digit as $key => $value) {
                $formattedData[] = ['title' => $value];
            }
	        return $this->sendSuccess('GAME NUMBER GET SUCCESSFULLY',$formattedData);
	    }else if($request->type =='jodi-digit'){
	        $digit = config('constants.jodi-digit');
	          $formattedData = [];
            foreach ($digit as $key => $value) {
                $formattedData[] = ['title' => $value];
            }
	        return $this->sendSuccess('GAME NUMBER GET SUCCESSFULLY',$formattedData);
	    }else if($request->type =='single-panna'){
	        $digit = config('constants.single-pana');
	        // Transform the array to the desired format
            $formattedData = [];
            foreach ($digit as $key => $value) {
                $formattedData[] = ['title' => $value];
            }
	        return $this->sendSuccess('GAME NUMBER GET SUCCESSFULLY',$formattedData);
	    }else if($request->type =='double-panna'){
	        $digit = config('constants.double-pana');
	        // Transform the array to the desired format
            $formattedData = [];
            foreach ($digit as $key => $value) {
                $formattedData[] = ['title' => $value];
            }
	        return $this->sendSuccess('GAME NUMBER GET SUCCESSFULLY',$formattedData);
	    }else if($request->type =='triple-panna'){
	        $digit = config('constants.tripple-pana');
	       // dd($digit);
	        // Transform the array to the desired format
            $formattedData = [];
            foreach ($digit as $key => $value) {
                $formattedData[] = ['title' => $value];
            }
	        return $this->sendSuccess('GAME NUMBER GET SUCCESSFULLY',$formattedData);
	    }else if($request->type =='half-sangam'){
	        if($request->session == 'open'){
	            $digit = config('constants.single-digit');
	        }else{
	            $digit = config('constants.panna');
	        }
	        // Transform the array to the desired format
            $formattedData = [];
            foreach ($digit as $key => $value) {
                $formattedData[] = ['title' => $value];
            }
	        return $this->sendSuccess('GAME NUMBER GET SUCCESSFULLY',$formattedData);
	    }else if($request->type =='full-sangam'){
	        $digit = config('constants.panna');
	        // Transform the array to the desired format
            $formattedData = [];
            foreach ($digit as $key => $value) {
                $formattedData[] = ['title' => $value];
            }
	        return $this->sendSuccess('GAME NUMBER GET SUCCESSFULLY',$formattedData);
	    }
	}
	
	function bidHistory(Request $request){
	    
	    $gameBid = StarLineGameBid::with('gameName')->where('user_id',$request->user_id)
	        ->where('user_id', $request->user_id)
            ->when($request->has('start_date'), function ($query) use ($request) {
                return $query->where('created_at', '>=', $request->start_date);
            })
            ->when($request->has('end_date'), function ($query) use ($request) {
                return $query->where('created_at', '<=', $request->end_date);
            })
	        ->get();
	    $data= [];
	    foreach($gameBid as $key => $val){
	   //   $val->game_names =   $val->gameName->name;
	      $data[$key]['bid_type'] = $val->bid_type;
	      $data[$key]['session'] = $val->session;
	      $data[$key]['net_balance'] = $this->getUserBalance($request->user_id);
	      $data[$key]['game_number'] = $val->game_number;
	      $data[$key]['point_quantity'] = $val->point_quantity;
	      $data[$key]['created_at'] = $val->created_at;
	      $data[$key]['game_name'] = isset($val->gameName->name) ? $val->gameName->name : '' ;
	     
	    }
	    return $this->sendSuccess('BID GET SUCCESSFULLY',[$data]);
	}
	
	
	 function getUserBalance($user_id){
	     
        $credit_balance = WalletTransaction::where(['user_id' => $user_id ,'type' => WalletTransaction::$credit])->sum('amount');
		$debit_balance = WalletTransaction::where(['user_id' => $user_id ,'type' => WalletTransaction::$debit])->sum('amount');
		$current_balance = $credit_balance - $debit_balance;
		return $current_balance;
    }
    
	function WinnerHistory(Request $request){
	    $winner = StarLineWinner::with('gameName')
            ->where('user_id', $request->user_id)
            ->when($request->has('start_date'), function ($query) use ($request) {
                return $query->where('winning_at', '>=', $request->start_date);
            })
            ->when($request->has('end_date'), function ($query) use ($request) {
                return $query->where('winning_at', '<=', $request->end_date);
            })
            ->get();

	    $data= [];
	    foreach($winner as $key => $val){
	   //   $val->game_names =   $val->gameName->name;
	      $data[$key]['bid_type'] = $val->bid_type;
	      $data[$key]['session'] = $val->session;
	      $data[$key]['game_number'] = $val->game_number;
	      $data[$key]['point_quantity'] = $val->point_quantity;
	      $data[$key]['winning_amount'] = $val->winning_amount;
	      $data[$key]['winning_at'] = $val->winning_at;
	      $data[$key]['game_name'] = isset($val->gameName->name) ? $val->gameName->name : '' ;
	       $data[$key]['net_balance'] = isset($val->net_balance) ? $val->net_balance : '' ;
	    }
	    return $this->sendSuccess('WINNING DATA GET SUCCESSFULLY',[$data]);
	    
	}
}
