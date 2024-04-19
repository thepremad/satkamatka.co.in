<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserProfileCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\GameBid;
use App\Models\User;
use App\Models\GameName;
use App\Models\Winner;
use App\Models\GameResult;
use App\Models\GameTime;
use App\Models\MoneyRequest;
use App\Models\WalletTransaction;
use App\Models\BankDetail;
use App\Models\TopPlayer;
use App\Models\MainSetting;
use App\Models\GameRate;
use App\Models\ValueMaster;
use App\Models\ContactSetting;
use App\Traits\ResponseWithHttpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GameNameController extends Controller
{
    use ResponseWithHttpRequest;
    function getAllGame(Request $request){
        

        
        
        $data = GameName::orderBy('today_open_time', 'asc')->get();
		foreach($data as $key=>$val){
			$val['result'] = $this->GetGameResults($val->id);
			$val['declare_open_time'] = date('H:i:s');
			$val['declare_close_time'] = date('H:i:s');
			$val['chart'] = route('chart',$val->id);
			
			$day_of_week =  date('l');
			$game_time = GameTime::where('game_name_id',$val->id)->where('day_of_week', 'like', $day_of_week)->first();
			
// 			echo $game_time;die;
			
			
			if(!empty($game_time)){
			 //   if($game_time->status == 1){
			        $is_running = 1;    
			 //   }
			}
			$val['is_running'] = isset($game_time) ? 1 : 0 ;
			
		}
		
		
		
		$user_data = User::where('id',$request->user_id)->first();
		if($user_data->status == '1'){
			    $status = 'Active';
			}else{
			    $status = 'Inactive';
			}
		$user_data['status'] = $status;
        return $this->sendSuccess('USER REGISTER SUCCESSFULLY', ['game' =>  GameResource::collection($data) ,'user_detail' => new UserProfileCollection($user_data)]);
    }

	function GetGameResults($id){
	    
	   // Get the current date and time using Carbon
        $currentDateTime = Carbon::now();
    
        // Check if the current time is before 5 AM
        if ($currentDateTime->hour < 5) {
            // Subtract one day from the current date
            $currentDateTime->subDay();
        }
    
        // Format the date for the view
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
            'bids.*.game_number' => 'required',
            'bids.*.point_quantity' => 'required|integer',
            'bids.*.session' => 'required|in:open,close',
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
                
                $balance = WalletTransaction::query()
                    ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
                    ->where('user_id', $user_id)
                    ->first();
                $actual_amount = $balance->balance ?? 0;
                
                $game_number = $bid['game_number'];
                $point_quantity = $bid['point_quantity'];
                $session = $bid['session'];

                // Proceed with creating the bids and wallet transactions as before
                $gameBid = GameBid::create([
                    'game_id' => $bid['game_id'],
                    'user_id' => $bid['user_id'],
                    'bid_type' => $bid['bid_type'],
                    'game_number' => $game_number,
                    'point_quantity' => $point_quantity,
                    'session' => $session,
                    'net_balance' => $actual_amount - $point_quantity,
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
    
    
    public function createSangamBid(Request $request)
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
            'bids.*.session' => 'required|in:open,close',
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
                $balance = WalletTransaction::query()
                    ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
                    ->where('user_id', $user_id)
                    ->first();
                $actual_amount = $balance->balance ?? 0;
                
                $game_number = $bid['game_number'];
                $game_number_sangam_close = $bid['game_number_sangam_close'];
                $point_quantity = $bid['point_quantity'];
                $session = $bid['session'];
                
                // Proceed with creating the bids and wallet transactions as before
                $gameBid = GameBid::create([
                    'game_id' => $bid['game_id'],
                    'user_id' => $bid['user_id'],
                    'bid_type' => $bid['bid_type'],
                    'game_number' => $game_number,
                    'game_number_sangam_close' => $game_number_sangam_close,
                    'point_quantity' => $point_quantity,
                    'session' => $session,
                    'net_balance' => $actual_amount - $point_quantity,
                    
                ]);

                WalletTransaction::create([
                    'user_id' => $bid['user_id'],
                    'amount' => $point_quantity,
                    'type' => WalletTransaction::$debit,
                    'game_id' => $bid['game_id'],
                    'net_balance' => $actual_amount - $point_quantity
                ]);
                
                $actual_amount - $point_quantity;
                
            }

            return $this->sendSuccess('BID CREATE SUCCESSFULLY');
        }

        return $this->sendFailed('INSUFFICIENT BALANCE', 200);
    }


    public function createBidOldJson(Request $request)
    {
        
                $jsonData = $request->json()->all();
dd($jsonData);
        $bids = $request->input('bids');
        $validator = Validator::make(['bids' => $bids], [
            'bids' => 'required|array',
            'bids.*.game_id' => 'required|integer|exists:game_names,id',
            'bids.*.user_id' => 'required|integer|exists:users,id',
            'bids.*.bid_type' => 'required|string',
            'bids.*.game_number' => 'required|integer',
            'bids.*.point_quantity' => 'required|integer',
            'bids.*.session' => 'required|in:open,close',
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
                $gameBid = GameBid::create([
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


    function createBidOldArray(Request $request) {
    $rules = [
        'game_id'        => 'required|integer|exists:game_names,id',
        'user_id'        => 'required|integer|exists:users,id',
        'bid_type'       => 'required|string|',
        'game_number'    => 'required|array', // Check if game_number is an array
        // 'game_number.*'  => 'required|integer', // Use * to indicate multiple values
        'point_quantity' => 'required|array', // Check if point_quantity is an array
        // 'point_quantity.*' => 'required|integer',
        'session'        => 'required|array', // Check if session is an array
        'session.*'      => 'required|in:open,close'
    ];
// dd($request->game_number);
    $validator = \Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return $this->sendFailed($validator->errors()->first(), 201);
    }

    $user_id = $request->user_id;
    $balance = WalletTransaction::query()
        ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
        ->where('user_id', $user_id)
        ->first();
    $actual_amount = $balance->balance ?? 0;
    // dd($actual_amount);
    if (count($request->game_number) !== count($request->point_quantity) || count($request->game_number) !== count($request->session)) {
        return $this->sendFailed('Invalid array inputs', 201);
    }

    $totalBidPoints = 0;

    for ($i = 0; $i < count($request->game_number); $i++) {
        $game_number = $request->game_number[$i];
        $point_quantity = $request->point_quantity[$i];
        $session = $request->session[$i];

        // Calculate the total bid points
        $totalBidPoints += $point_quantity;
    }
    // dd($actual_amount,$totalBidPoints);
    if ($actual_amount >= $totalBidPoints) {
        for ($i = 0; $i < count($request->game_number); $i++) {
            $game_number = $request->game_number[$i];
            $point_quantity = $request->point_quantity[$i];
            $session = $request->session[$i];

            // Proceed with creating the bids and wallet transactions as before
            $gameBid = GameBid::create([
                'game_id' => $request->game_id,
                'user_id' => $request->user_id,
                'bid_type' => $request->bid_type,
                'game_number' => $game_number,
                'point_quantity' => $point_quantity,
                'session' => $session
            ]);

            WalletTransaction::create([
                'user_id' => $request->user_id,
                'amount' => $point_quantity,
                'type' => WalletTransaction::$debit,
                'game_id' => $request->game_id,
                'net_balance' => $actual_amount - $point_quantity
            ]);
        }

        return $this->sendSuccess('BID CREATE SUCCESSFULLY');
    }

    return $this->sendFailed('INSUFFICIENT BALANCE', 200);
}


    function createBidOld(Request $request){
        
		$rules = [
			'game_id' 		 => 'required|integer|exists:game_names,id',
			'user_id' 		 => 'required|integer|exists:users,id',
			'bid_type' 		 => 'required|string|',
			'game_number' 	 => 'required|integer',
			'point_quantity' => 'required|integer',
			'session'		 => 'required|in:open,close'
			
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		$user_id = $request->user_id;
		$balance = WalletTransaction::query()
            ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
            ->where('user_id', $user_id)
            ->first();
        $actual_amount = $balance->balance ?? 0;
        // dd($actual_amount);
        if ($actual_amount >= $request->point_quantity) {
            $gameBid = GameBid::create($request->all());
            // dd($request->point_quantity);
            WalletTransaction::where('user_id', $user_id)->create(
                [
                    'user_id' => $request->user_id,
                    'amount' => $request->point_quantity,
                    'type' => WalletTransaction::$debit,
                    'game_id' => $request->game_id,
                    'net_balance' => $actual_amount - $request->point_quantity
                ]
            );
            return $this->sendSuccess('BID CREATE SUCCESSFULLY');
        }
    return $this->sendFailed('INSUFFICIENT BALANCE', 200);            
        
    }
    
    function createSangamBid12(Request $request) {
        
    $rules = [
        'game_id'        => 'required|integer|exists:game_names,id',
        'user_id'        => 'required|integer|exists:users,id',
        'bid_type'       => 'required|string|',
        'game_number'    => 'required|array', // Check if game_number is an array
        'point_quantity' => 'required|array', // Check if point_quantity is an array
        'game_number_sangam_close' => 'array',
    ];
// dd($request->game_number);
    $validator = \Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return $this->sendFailed($validator->errors()->first(), 201);
    }

    $user_id = $request->user_id;
    $balance = WalletTransaction::query()
        ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
        ->where('user_id', $user_id)
        ->first();
    $actual_amount = $balance->balance ?? 0;
    // dd($actual_amount);
    if (count($request->game_number) !== count($request->point_quantity) || count($request->game_number) !== count($request->game_number_sangam_close)) {
        return $this->sendFailed('Invalid array inputs', 201);
    }

    $totalBidPoints = 0;

    for ($i = 0; $i < count($request->game_number); $i++) {
        $game_number = $request->game_number[$i];
        $point_quantity = $request->point_quantity[$i];
        // $session = $request->session[$i];

        // Calculate the total bid points
        $totalBidPoints += $point_quantity;
    }
    // dd($actual_amount,$totalBidPoints);
    if ($actual_amount >= $totalBidPoints) {
        for ($i = 0; $i < count($request->game_number); $i++) {
            $game_number = $request->game_number[$i];
            $game_number_sangam_close = $request->game_number_sangam_close[$i];
            $point_quantity = $request->point_quantity[$i];
            // $session = $request->session[$i];

            // Proceed with creating the bids and wallet transactions as before
            $gameBid = GameBid::create([
                'game_id' => $request->game_id,
                'user_id' => $request->user_id,
                'bid_type' => $request->bid_type,
                'game_number' => $game_number,
                '$game_number_sangam_close' => $game_number_sangam_close,
                'point_quantity' => $point_quantity,
                'session' => 'close'
            ]);

            WalletTransaction::create([
                'user_id' => $request->user_id,
                'amount' => $point_quantity,
                'type' => WalletTransaction::$debit,
                'game_id' => $request->game_id,
                'net_balance' => $actual_amount - $point_quantity
            ]);
        }

        return $this->sendSuccess('BID CREATE SUCCESSFULLY');
    }

    return $this->sendFailed('INSUFFICIENT BALANCE', 200);
}
    
    function createSangamBidOld(Request $request){
        
		$rules = [
			'game_id' 		 => 'required|integer|exists:game_names,id',
			'user_id' 		 => 'required|integer|exists:users,id',
			'bid_type' 		 => 'required|string|',
			'game_number' 	 => 'required|integer',
			'game_number_sangam_close' => 'required|integer',
			'point_quantity' => 'required|integer',
// 			'session'		 => 'required|in:open,close'
			
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		$user_id = $request->user_id;
// 		$request->session = 'close';
		$request['session'] = 'close';
		$balance = WalletTransaction::query()
            ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
            ->where('user_id', $user_id)
            ->first();
        $actual_amount = $balance->balance ?? 0;
        // dd($actual_amount);
        if (true || $actual_amount >= $request->point_quantity) {
            $gameBid = GameBid::create($request->all());
            // dd($request->point_quantity);
            WalletTransaction::where('user_id', $user_id)->create(
                [
                    'user_id' => $request->user_id,
                    'amount' => $request->point_quantity,
                    'type' => WalletTransaction::$debit,
                    'game_id' => $request->game_id,
                    'net_balance' => $actual_amount - $request->point_quantity
                ]
            );
            return $this->sendSuccess('BID CREATE SUCCESSFULLY');
        }
    return $this->sendFailed('INSUFFICIENT BALANCE', 200);            
        
    }

	function addMoneyRequest(Request $request){
		$rules = [
			'user_id' => 'required|integer|exists:users,id',
			'amount' => 'required|integer',
		];
		$transaction_id = isset($request->transaction_id) ? $request->transaction_id :'';
		$status = isset($request->status) ? $request->status :'';
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		MoneyRequest::create(['user_id' => $request->user_id ,'amount' => $request->amount ,'payment_status' => $status ,'transaction_id' => $request->transaction_id]);
		return $this->sendSuccess('REQUEST CREATE SUCCESSFULLY');
	}

	function mymoneyRequest(Request $request){
		$rules = [
			'user_id' => 'required|integer|exists:users,id',
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		$requests = MoneyRequest::where('user_id',$request->user_id)->orderBy('id','DESC')->get();
		return $this->sendSuccess('REQUEST CREATE SUCCESSFULLY',$requests);
	}

	function myWallet(Request $request){
		$rules = [
			'user_id' => 'required|integer|exists:users,id',
		];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		$transaction = WalletTransaction::where('user_id',$request->user_id)->orderBy('id','DESC')->get();
		$credit_balance = WalletTransaction::where(['user_id' => $request->user_id ,'type' => WalletTransaction::$credit])->sum('amount');
		
		$debit_balance = WalletTransaction::where(['user_id' => $request->user_id ,'type' => WalletTransaction::$debit])->sum('amount');
		$current_balance = $credit_balance - $debit_balance;
		return $this->sendSuccess('REQUEST CREATE SUCCESSFULLY',['balance' => $current_balance ,'transaction' => $transaction]);
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
	    
	   $gameBid = GameBid::with('gameName')->where('user_id',$request->user_id);
	    
	    
	    
	   if(!empty($request->start_date)){
            if(!empty($request->end_date)){
                $endDate = $request->end_date;
            }else{
                $endDate = date('Y-m-d');
            }
            $gameBid->whereDate('created_at','>=',$request->start_date)->whereDate('created_at','<=',$endDate);
        } 
	    
	    
	   $gameBid = $gameBid->where('user_id', $request->user_id)->latest()->get();
	    $data= [];
	    foreach($gameBid as $key => $val){
	   //   $val->game_names =   $val->gameName->name;
	      $data[$key]['bid_type'] = $val->bid_type;
	      $data[$key]['session'] = $val->session;
	   //   $data[$key]['net_balance'] = $this->getUserBalance($request->user_id);
	      $data[$key]['net_balance'] = $val->net_balance;
	      $data[$key]['game_number'] = $val->game_number;
	      $data[$key]['game_number_sangam_close'] = $val->game_number_sangam_close ?? '';
	      $data[$key]['point_quantity'] = $val->point_quantity;
	      $data[$key]['created_at'] = $val->created_at;
	      $data[$key]['game_name'] = isset($val->gameName->name) ? $val->gameName->name : '' ;
	     
	    }
	    return $this->sendSuccess('BID GET SUCCESSFULLY',[$data]);
	    
	}
	
	function WinnerHistory(Request $request){
    $winner = Winner::with('gameName');
            $winner->where('user_id', $request->user_id);
            if(!empty($request->start_date)){
                if(!empty($request->end_date)){
                    $endDate = $request->end_date;
                }else{
                    $endDate = date('Y-m-d');
                }
                $winner->whereDate('winning_at','>=',$request->start_date)->whereDate('winning_at','<=',$endDate);
            } 
            
            $winner = $winner->get();

	    $data= [];
	    foreach($winner as $key => $val){
	   //   $val->game_names =   $val->gameName->name;
	      $data[$key]['bid_type'] = $val->bid_type;
	      $data[$key]['session'] = $val->session;
	      $data[$key]['game_number'] = $val->game_number;
	      $data[$key]['game_number_sangam_close'] = $val->game_number_sangam_close ?? '';
	      $data[$key]['point_quantity'] = $val->point_quantity;
	      $data[$key]['winning_amount'] = $val->winning_amount;
	      $data[$key]['winning_at'] = $val->winning_at;
	      $data[$key]['game_name'] = isset($val->gameName->name) ? $val->gameName->name : '' ;
	       $data[$key]['net_balance'] = isset($val->net_balance) ? $val->net_balance : '' ;
	    }
	    return $this->sendSuccess('WINNING DATA GET SUCCESSFULLY',[$data]);
	    
	}
	
	function withdrawal(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer|exists:users,id',
            'withdrawal_amount' => 'required|numeric|min:500',
            'payment_method' => 'required|in:bank,phonepay,googlepay,paytm'
        ];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		
		$get_with_time =  ValueMaster::first();
		
		$withdrawal_open_time = isset($get_with_time->withdrawal_open_time) ? $get_with_time->withdrawal_open_time : '06:00:00';
		$withdrawal_close_time = isset($get_with_time->withdrawal_close_time) ? $get_with_time->withdrawal_close_time : '16:00:00';
		
		
		if (strtotime(date("H:i:s")) > strtotime($withdrawal_open_time)  &&  strtotime(date("H:i:s")) < strtotime($withdrawal_close_time)) {
            
        }else{
            return $this->sendFailed("withdrawal time is $withdrawal_open_time to $withdrawal_close_time", 201);
        }

		
		if(!BankDetail::whereUserId($request->user_id)->exists()){
		    return $this->sendFailed('Please add payment method', 201);
		}
		
		
		
		
		$check_with = MoneyRequest::where('user_id',$request->user_id)->where('type','1')->where('status','0')->first();
		if(!empty($check_with)){
		    return $this->sendFailed('YOU HAVE ALREADY REQUESTED', 200);
		}
		
        $withdrawal_amount = $request->withdrawal_amount;
        $user_id = $request->user_id;
    
        $balance = DB::table('wallet_transactions')
            ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE -amount END) AS balance', [WalletTransaction::$credit])
            ->where('user_id', $user_id)
            ->first();
        $actual_amount = $balance->balance ?? 0;
        if ($actual_amount >= $withdrawal_amount) {
            
            //['user_id','amount','status','type','transaction_id','payment_status','payment_method'];
            MoneyRequest::create([
                'user_id' => $user_id,
                'type' => '1',
                'status' => '0',
                'amount' => $withdrawal_amount,
                'payment_method' => $request->payment_method
            ]);
    
            return $this->sendSuccess('AMOUNT WITHDRAWAL SUCCESSFULLY');
        }
    
        return $this->sendFailed('INSUFFICIENT BALANCE', 200);
    }
    
    public function transactionHistory(Request $request)
    {
        $user_id = $request->user_id;
        $history = WalletTransaction::with('gameName:name,id')
            ->when($request->has('start_date'), function ($query) use ($request) {
                // $startDate = date('Y-m-d H:i:s', strtotime($request->start_date));
                // return $query->where('created_at', '>=', $startDate);
            })
            ->when($request->has('end_date'), function ($query) use ($request) {
                // $endDate = date('Y-m-d H:i:s', strtotime($request->end_date));
                // return $query->where('created_at', '<=', $endDate);
            })

           
            ->where('user_id', $user_id)
            ->orderBy('id','desc')
            ->get(['id', 'amount', 'type', 'created_at', 'net_balance', 'game_id','desc']);
    
        // Map type values to "Debit" or "Credit"
        $history->transform(function ($transaction) {
            $transaction->type = $transaction->type === WalletTransaction::$debit ? 'Debit' : 'Credit';
            $transaction->transaction_date = date('Y-m-d H:i:s', strtotime($transaction->created_at));
            return $transaction;
        });
    
        $history->map(function ($item) {
          return  $item->game_name = $item->gameName ? $item->gameName->name : '';
        });
    
        return $this->sendSuccess('Wallet Transaction History Retrieved Successfully', $history);
    }

    function saveBankDetail(Request $request){
        
         $rules = [
            'user_id' => 'required|integer|exists:users,id',
            'type' => 'required|in:bank,upi'
        ];
        $message = [
                     'upi_type.in' => 'The selected upi type is invalid. Only accepted phonepay, googlepay, paytm.'
            ];
        // Add conditional validation rules for 'upi_type'
        if ($request->input('type') === 'upi') {
            $rules['upi_type'] = 'required|in:phonepay,googlepay,paytm';
        }
        
		$validator = \Validator::make($request->all(), $rules,$message);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		
		$bankDetail = BankDetail::where(['user_id' => $request->user_id,'type' => $request->type])->first();
		if($bankDetail){
		    if($request->type == 'bank'){
		        $bankDetail->update([
                    'acccount_holder_name' => $request->acccount_holder_name,
                    'acccount_number' => $request->acccount_number,
                    'ifsc_code' => $request->ifsc_code,
                    'bank_name' => $request->bank_name,
                    'branch_address' => $request->branch_address,
                ]);
		    }else{
		        $checkBankDetail = BankDetail::where(['user_id' => $request->user_id,'type' => $request->type,'upi_type' => $request->upi_type])->first();
		      //  dd($checkBankDetail);
		        if($checkBankDetail){
		            $checkBankDetail->update([
                    'upi_id' => $request->upi_id,
                    ]);
		        }else{
		            $bankDetail = BankDetail::create(
                        [
                        'user_id' => $request->user_id,
                        'type' => $request->type,
                        'upi_id' => $request->upi_id,
                        'upi_type' => $request->upi_type,
                        ]
                    );
		        }
		    }
		}else{
		    $bankDetail = BankDetail::create(
                    [
                        'user_id' => $request->user_id,
                        'type' => $request->type,
                        'acccount_holder_name' => $request->acccount_holder_name,
                        'acccount_number' => $request->acccount_number,
                        'ifsc_code' => $request->ifsc_code,
                        'bank_name' => $request->bank_name,
                        'branch_address' => $request->branch_address,
                        'upi_id' => $request->upi_id,
                        'upi_type' => $request->upi_type,
                    ]
                );
		}
            return $this->sendSuccess('Bank details save Successfully');
    }
    
    function saveBankDetail2(Request $request){
        
         $rules = [
            'user_id' => 'required|integer|exists:users,id',
            'type' => 'required|in:bank,upi'
        ];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		
        $bankDetail = BankDetail::updateOrCreate(
            [
                'user_id' => $request->user_id
            ],
            [
                'user_id' => $request->user_id,
                'type' => $request->type,
                'acccount_holder_name' => $request->acccount_holder_name,
                'acccount_number' => $request->acccount_number,
                'ifsc_code' => $request->ifsc_code,
                'bank_name' => $request->bank_name,
                'branch_address' => $request->branch_address,
                'upi_id' => $request->upi_id,
                ]
            );
            return $this->sendSuccess('Bank details save Successfully');
    }
    
    function getBankDetail(Request $request) {
    $bankDetail = BankDetail::whereUserId($request->user_id)->get();

    if ($bankDetail->isEmpty()) {
        $response = [
            'ResponseCode' => 404,
            'Status' => false,
            'Message' => 'No bank details found.',
            'Data' => [],
        ];

        return response()->json($response);
    }

    $paymentMethods = [];

    $bankExists = $bankDetail->contains('type', 'bank');
    $upiTypes = $bankDetail->pluck('upi_type')->filter()->unique()->toArray();

    if ($bankExists) {
        $paymentMethods[] = [
            'id' => 1,
            'title' => 'bank',
        ];
    }

    foreach ($upiTypes as $index => $type) {
        if (strtolower($type) !== 'googlepay') {
            $paymentMethods[] = [
                'id' => $index + 2, // Start from 2 since 'bank' is already added if applicable
                'title' => $type,
            ];
        }
    }

    $updatedBankDetail = $bankDetail->map(function ($item) use ($paymentMethods) {
        $paymentMethodTitle = null;

        if ($item->type === 'upi') {
            if (strtolower($item->upi_type) === 'googlepay') {
                $paymentMethodTitle = 'GooglePay';
            } else {
                foreach ($paymentMethods as $paymentMethod) {
                    if (strtolower($paymentMethod['title']) === strtolower($item->upi_type)) {
                        $paymentMethodTitle = $paymentMethod['title'];
                        break;
                    }
                }
            }
        }

        return array_merge($item->toArray(), ['payment_method' => $paymentMethodTitle]);
    });

    $response = [
        'ResponseCode' => 200,
        'Status' => true,
        'Message' => 'Bank details saved successfully',
        'Data' => $updatedBankDetail,
        'PaymentMethods' => $paymentMethods, // Updated payment methods array
    ];

    return response()->json($response);
}






     function getBankDetail2(Request $request){
            $bankDetail = BankDetail::whereUserId($request->user_id)->get();
            return $this->sendSuccess('Bank details get Successfully',$bankDetail);
    }
    
    function getUserBalance($user_id){
        $credit_balance = WalletTransaction::where(['user_id' => $user_id ,'type' => WalletTransaction::$credit])->sum('amount');
		$debit_balance = WalletTransaction::where(['user_id' => $user_id ,'type' => WalletTransaction::$debit])->sum('amount');
		$current_balance = $credit_balance - $debit_balance;
		return $current_balance;
    }
    
    function settings(){
        $mainSetting = MainSetting::first();
        $ValueMaster = ValueMaster::first();
        $ContactSetting = ContactSetting::first();
        
        if(!empty($mainSetting->notice_board)){
            $notice_board = json_decode($mainSetting->notice_board);
        }else{
            $notice_board = "";
        }
        
        if(!empty($mainSetting->rules)){
            $rules = json_decode($mainSetting->rules);
        }else{
            $rules = "";
        }
        
        if(!empty($mainSetting->slider_images)){
            $slider_images = json_decode($mainSetting->slider_images);
        }else{
            $slider_images = [];
        }
        
        $new_slider_images = [];
        foreach($slider_images as $key=>$val){
            $new_slider_images[] = asset('public/uploads/').'/'.$val;
        }
        
        
        $game_rate = GameRate::get();
        $data = [
            'main_setting' => [
                'bank_detail' => json_decode($mainSetting->bank_detail),
                'app_link' => json_decode($mainSetting->app_link),
                'upi_id' => json_decode($mainSetting->upi_ids)
                ],
            'values' => $ValueMaster,
            'contact_setting' => $ContactSetting,
            'game_rate' => $game_rate,
            'rules' => $rules,
            'notice_board' => $notice_board,
            'slider_images' => $new_slider_images,
            'marquee_notification' => isset($mainSetting->marquee_notification) ? $mainSetting->marquee_notification : ''
            ];
        return $this->sendSuccess('Bank details save Successfully',$data);
    }
    
    function spDpGetNumber(Request $request){
        $digit = $request->digit;
        $data = [];
        
        
        if($request->singal == 1){
            $single_panna = config('constants.single-pana');
            foreach($single_panna as $key => $val){
                $digits = str_split($val);
                $sum = array_sum($digits);
                $stringValue = (string)$sum;
                $digit_2 = substr($stringValue, -1);
                
                if($digit_2 == $digit){
                    $data[] = $val;
                }
            }    
        }
        
        if($request->doubal == 1){
            $single_panna = config('constants.double-pana');
            foreach($single_panna as $key => $val){
                $digits = str_split($val);
                $sum = array_sum($digits);
                $stringValue = (string)$sum;
                $digit_2 = substr($stringValue, -1);
                
                if($digit_2 == $digit){
                    $data[] = $val;
                }
            }    
        }
        
        if($request->tripal == 1){
            $single_panna = config('constants.tripple-pana');
            foreach($single_panna as $key => $val){
                $digits = str_split($val);
                $sum = array_sum($digits);
                $stringValue = (string)$sum;
                $digit_2 = substr($stringValue, -1);
                
                if($digit_2 == $digit){
                    $data[] = $val;
                }
            }    
        }
        
        
        return $this->sendSuccess('sp dp tp data fetch Successfully',$data);
    }
    
    public function geTwoDigPannel(Request $request){
        $digit = $request->digit;
        $single_panna = config('constants.single-pana');
        $doubal_panna = config('constants.double-pana');
        $tripple_panna = config('constants.tripple-pana');
        
        $number = $digit;
        $digit2 = $number % 10;  
        $number = (int)($number / 10);  
        $digit5 = $number % 10;  
        
        $all_data = [];
        
        
        foreach($single_panna as $key){
            $number = $key;   
            $numberStr = (string)$number;
            
            if (strpos($numberStr, $digit2) !== false && strpos($numberStr, $digit5) !== false) {
               $all_data[] = $number;
            } 
        }
        
        foreach($doubal_panna as $key){
            $number = $key;   
            $numberStr = (string)$number;
            
            if (strpos($numberStr, $digit2) !== false && strpos($numberStr, $digit5) !== false) {
               $all_data[] = $number;
            } 
        }
        
        foreach($tripple_panna as $key){
            $number = $key;   
            $numberStr = (string)$number;
            
            if (strpos($numberStr, $digit2) !== false && strpos($numberStr, $digit5) !== false) {
               $all_data[] = $number;
            } 
        }
        
        return $this->sendSuccess('Two digit panel data fetch Successfully',$all_data);
    }
    
    public function getTopPlayers(){
        $data = TopPlayer::get()->map(function($player){
            if(empty($player->image)){
                $player->image = 'download.png';
            }
            $game =  GameName::find($player->game_id);
            $player->game_name = isset($game->name) ? $game->name :'';
            $player->image = asset('public/images/').'/'.$player->image;
            return $player;
        });
        return $this->sendSuccess('Top players data fetch Successfully',$data);
    }
    
    public function sendOtp(Request $request){
        $mobile = isset($request->mobile) ? $request->mobile :'';
        $get = User::where('mobile',$mobile)->first();
        if($get){
            $otp = rand(1111,9999);
            $get->update(['otp'=> $otp]);    
            $curl = curl_init();
    		$api_key = "1ExCr4QnkmbKoF9fDZqi6YAlwyu5VPUsLcghvTRtH0O2XGISMNQMlhZmV1aCc2qBEHgd5KorieYOtbkP";
    
    		curl_setopt_array($curl, array(
    		  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=".$api_key."&variables_values=".$otp."&route=otp&numbers=".urlencode($mobile),
    		  CURLOPT_RETURNTRANSFER => true,
    		  CURLOPT_ENCODING => "",
    		  CURLOPT_MAXREDIRS => 10,
    		  CURLOPT_TIMEOUT => 30,
    		  CURLOPT_SSL_VERIFYHOST => 0,
    		  CURLOPT_SSL_VERIFYPEER => 0,
    		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    		  CURLOPT_CUSTOMREQUEST => "GET",
    		  CURLOPT_HTTPHEADER => array(
    		    "cache-control: no-cache"
    		  ),
    		));
    
    		$response = curl_exec($curl);
    		$err = curl_error($curl);
    		curl_close($curl);
    		 return $this->sendSuccess('Otp send successfully');
        }else{
            return $this->sendFailed('mobile number not exist', 201);
        }
    }
    
    public function verifyOtp(Request $request){
        $rules = [
            'mobile' => 'required|integer|exists:users,mobile',
            'otp' => 'required|numeric|digits:4',
            // 'password' => 'required|min:4',
            // 'confirm_password' => 'required|same:password',
        ];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		
		$user = User::where('mobile',$request->mobile)->where('otp',$request->otp)->first();
		if($user){
		  //  $user->update(['password' => Hash::make($request->password),'otp' => '']);
		     return $this->sendSuccess('Password change successfully',$user);
		}else{
		     return $this->sendFailed('otp does not match', 201);
		}
    }
    
     public function setPassword(Request $request){
        $rules = [
            'user_id' => 'required|integer|exists:users,id',
            // 'otp' => 'required|numeric|digits:4',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ];
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return $this->sendFailed($validator->errors()->first(), 201);
		}
		
		
// 		if($user){
		    User::where('id',$request->user_id)->update(['password' => Hash::make($request->password),'otp' => '']);
		     return $this->sendSuccess('Password change successfully');
// 		}else{
		  //   return $this->sendFailed('otp does not match', 201);
// 		}
    }
    
    
    function getPannelGroup(Request $request){
        $digit = $request->digit;
        
        $single_panna = config('constants.single-pana');
        $doubal_panna = config('constants.double-pana');
        $tripple_panna = config('constants.tripple-pana');
        
        $sum = str_split($digit);
        $sum = array_sum($sum);
        $stringValue = (string)$sum;
        $digit_sum_1 = substr($stringValue, -1);
        
        $digit_2 = $digit_sum_1 + 5;
        
        
        $sum = str_split($digit_2);
        $sum = array_sum($sum);
        $stringValue = (string)$sum;
        $digit_sum_2 = substr($stringValue, -1);
        
        $data = [];
        
        $all_panna = array_merge($single_panna,$doubal_panna,$tripple_panna);
        foreach($all_panna as $key=>$val){
            $sum = str_split($val);
            $sum = array_sum($sum);
            $stringValue = (string)$sum;
            $sum = substr($stringValue, -1);
            
            if($sum == $digit_sum_1 || $sum == $digit_sum_2){
                $data[] = $val;
            }
        }
        return $this->sendSuccess('Panel group data fetch Successfully',$data);
    }
    
    
    
    
}
