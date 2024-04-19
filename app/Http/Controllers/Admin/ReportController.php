<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameName;
use App\Http\Requests\StoreGameNameRequest;
use App\Http\Requests\UpdateGameNameRequest;
use App\Models\GameRate;
use App\Models\GameTime;
use App\Models\GameBid;
use App\Models\Winner;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function userBidHistory(Request $request)
    {   
        $gameNameList = GameName::pluck('name','id');
        
            $bidHistory = GameBid::with('user','gameName');
            if($request->bid_type != 'all-type'){
                $bidHistory->where('bid_type',$request->bid_type);
            }
            $bidHistory->where('game_id',$request->game_id);
            if(!empty($request->bid_date)){
                $bid_date = $request->bid_date;
            }else{
                $bid_date = date('Y-m-d');
            }
            $bidHistory->whereDate('created_at',$bid_date);
            $bidHistory = $bidHistory->get()->map(function($bid){
                $bid['oppen_panna_result'] = "-";
                $bid['close_panna_result'] = "-";
                $bid['oppen_digit_result'] = "-";
                $bid['close_digit_result'] = "-";
                
                $bidType = $bid->bid_type;
                
                if($bidType == '2-digit-panel' || $bidType == 'sp-dp-tp' || $bidType == 'panel-group'){
                    $single_panna = config('constants.single-pana');
                    $doubal_panna = config('constants.double-pana');
                    $tripple_panna = config('constants.tripple-pana');
                    foreach($single_panna as $key){
                        if($key == $bid->game_number){
                             $bidType = 'single-panna';
                        } 
                    }
                    foreach($doubal_panna as $key){
                       if($key == $bid->game_number){
                             $bidType = 'double-panna';
                        } 
                    }
                    foreach($tripple_panna as $key){
                        if($key == $bid->game_number){
                             $bidType = 'triple-panna';
                        } 
                    }
                }
                
                // echo $bid;die;
                if($bidType == 'single-digit'){
                    if($bid->session == 'open'){
                        $bid['oppen_digit_result'] = $bid->game_number;   
                    }else{
                        $bid['close_digit_result'] = $bid->game_number;
                    }
                }elseif($bidType == 'jodi-digit'){
                    $bid['oppen_digit_result'] = substr($bid->game_number, 0, 1);
                    $bid['close_digit_result'] = substr($bid->game_number, 1, 1);
                    
                }elseif($bidType == 'single-panna' || $bidType == 'double-panna' || $bidType == 'tripple-panna'){
                    if($bid->session == 'open'){
                        $bid['oppen_panna_result'] = $bid->game_number;   
                    }else{
                        $bid['close_panna_result'] = $bid->game_number;
                    }
                }elseif($bidType == 'half-sangam'){
                    $bid['oppen_digit_result'] = $bid->game_number;
                    $bid['close_digit_result'] = $bid->game_number_sangam_close;
                    // echo $bid;die;
                }elseif($bidType == 'full-sangam'){
                    $bid['oppen_panna_result'] = $bid->game_number;
                    $bid['close_digit_result'] = $bid->game_number_sangam_close;
                    // echo $bid;die;
                }
                
                // echo $bid;die;        
                return $bid;
            });
            
            
            
        return view('backend.reports.user-bid-history',compact('gameNameList','bidHistory','request'));
    }

    function getBidDetails(Request $request) {
    try {
        $bidData = GameBid::find($request->bid_id);
        
        $html = '';
        $csrf = csrf_field();  // Generating csrf field
        $html .= '<form class="theme-form" action="'.route("admin.update_bid").'" method="post">'.$csrf;
        $html .= '
        <div class="row">
            <input type="hidden" id="bid_id" name="bid_id" value="'.$request->bid_id.'">
            <div class="col-12">
                <label for="game_number">Digit</label>
                <select id="game_number" name="game_number" class="form-control">
                    ';
        $getGameNumber = self::getGameNumber($bidData->bid_type);
        
        foreach ($getGameNumber as $key => $val) {
            $selected = ($bidData->game_number == $key) ? 'selected="selected"' : '';
            $html .= '
                    <option value="'.$key.'" '.$selected.'>'.$val.'</option>
            ';
        }
        
        $html .= '
                </select>
                </br>
            </div>
            
            
            <div class="col-12">
                <button type="submit" class="btn btn-primary waves-light m-t-10">Submit</button>
            </div>
        </div>
        <div class="form-group">
            <div id=""></div>
        </div>
        </form>';
        
        return response()->json(['success' => 'data get ', 'data' => $html]);
    } catch (\Throwable $e) {
        \DB::rollback();
        return response()->json(['error' => $e->getMessage() . ' on line ' . $e->getLine()]);
    }
    }


    function updateBid(Request $request){
        $bidData = GameBid::find($request->bid_id);
        $bidData->game_number = $request->game_number;
        $bidData->save();
        return redirect()->back()->with('success','bid update success.');
    }

    function getGameNumber($type, $session = null) {
        $digit = [];
    
        if ($type == 'single-digit') {
            $digit = config('constants.single-digit');
        } else if ($type == 'jodi-digit') {
            $digit = config('constants.jodi-digit');
        } else if ($type == 'single-panna') {
            $digit = config('constants.single-pana');
        } else if ($type == 'double-panna') {
            $digit = config('constants.double-pana');
        } else if ($type == 'triple-panna') {
            $digit = config('constants.triple-pana');
        } else if ($type == 'half-sangam') {
            if ($session == 'open') {
                $digit = config('constants.single-digit');
            } else {
                $digit = config('constants.panna');
            }
        } else if ($type == 'full-sangam') {
            $digit = config('constants.panna');
        }
    
        return $digit;
    }


    public function winningReport(Request $request)
        {
            
            
            $gameNameList = GameName::pluck('name','id');
            
                $winner = Winner::orderBy('id','DESC');
                
                if($request->bid_type != 'all-type' && !empty($request->bid_type)){
                    $winner->where('bid_type',$request->bid_type);
                }
                if(!empty($request->bid_date)){
                    $bid_date = $request->bid_date;
                }else{
                    $bid_date = date('Y-m-d');
                }
                
                if(!empty($request->game_id)){
                    $winner->where('game_id',$request->game_id);
                }
                
                
                $winner->whereDate('created_at',$bid_date);
                $winner = $winner->get()->map(function($bid){
                    $bid['oppen_panna_result'] = "-";
                    $bid['close_panna_result'] = "-";
                    $bid['oppen_digit_result'] = "-";
                    $bid['close_digit_result'] = "-";
                    
                    $bidType = $bid->bid_type;
                    
                    if($bidType == '2-digit-panel' || $bidType == 'sp-dp-tp' || $bidType == 'panel-group'){
                        $single_panna = config('constants.single-pana');
                        $doubal_panna = config('constants.double-pana');
                        $tripple_panna = config('constants.tripple-pana');
                        foreach($single_panna as $key){
                            if($key == $bid->game_number){
                                 $bidType = 'single-panna';
                            } 
                        }
                        foreach($doubal_panna as $key){
                           if($key == $bid->game_number){
                                 $bidType = 'double-panna';
                            } 
                        }
                        foreach($tripple_panna as $key){
                            if($key == $bid->game_number){
                                 $bidType = 'triple-panna';
                            } 
                        }
                    }
                    
                    // echo $bid;die;
                    if($bidType == 'single-digit'){
                        if($bid->session == 'open'){
                            $bid['oppen_digit_result'] = $bid->game_number;   
                        }else{
                            $bid['close_digit_result'] = $bid->game_number;
                        }
                    }elseif($bidType == 'jodi-digit'){
                        $bid['oppen_digit_result'] = substr($bid->game_number, 0, 1);
                        $bid['close_digit_result'] = substr($bid->game_number, 1, 1);
                        
                    }elseif($bidType == 'single-panna' || $bidType == 'double-panna' || $bidType == 'tripple-panna'){
                        if($bid->session == 'open'){
                            $bid['oppen_panna_result'] = $bid->game_number;   
                        }else{
                            $bid['close_panna_result'] = $bid->game_number;
                        }
                    }elseif($bidType == 'half-sangam'){
                        $bid['oppen_digit_result'] = $bid->game_number;
                        $bid['close_digit_result'] = $bid->game_number_sangam_close;
                        // echo $bid;die;
                    }elseif($bidType == 'full-sangam'){
                        $bid['oppen_panna_result'] = $bid->game_number;
                        $bid['close_digit_result'] = $bid->game_number_sangam_close;
                        // echo $bid;die;
                    }
                    
                    return $bid;
                });
            return view('backend.reports.winning-report',compact('gameNameList','winner','request'));
        }
        
     function bidWinningReport(Request $request)
        {
            $gameNameList = GameName::pluck('name','id');
            return view('backend.reports.bid-winning-report',compact('gameNameList'));
        }
        
    function getBidWinningReportDetails(Request $request)
    {
        try {
         $bid_amount =     GameBid::whereDate('created_at',$request->date)->where('game_id',$request->game_id)->select('game_id',\DB::raw('SUM(point_quantity) AS bid_amount'))->groupBy('game_id')->first();
         $winning_amount =  Winner::whereDate('created_at',$request->date)->where('game_id',$request->game_id)->select(\DB::raw('SUM(winning_amount) AS winning_amount'))->groupBy('game_id')->first();
         $bid_amount = $bid_amount ? $bid_amount->bid_amount : 0;
         $winning_amount = $winning_amount ? $winning_amount->winning_amount : 0;
         $loss = false;
         if($winning_amount > $bid_amount){
             $loss = true;
             $amount = $winning_amount - $bid_amount;
         }else{
             $amount = $bid_amount - $winning_amount;
         }
         $html = '<div class="row">
    		        <div class="col-md-6">
    					<div class="bid_history_box bhb_bid_amt">
    						<div class="row">
    						    <div class="col-md-6">    
    						     <h5 class="text-muted font-weight-medium">Total Bid Amount</h5>
    						    </div>
    						    <div class="col-md-3"> 
    						        <h5 id="total_bid_amt"><i class="bx bx-rupee"></i>'.$bid_amount.'</h5>
    						    </div>
    						    <div class="col-md-3 text-sm-right"> 
    						     <button type="button" class="btn btn-primary waves-light btn-xs" onclick="OpenBidHistory();" id="winner_btn">View</button>
    						     </div>
    						</div>
    					</div>
    					<div class="bid_history_box bhb_win_amt">
    					    <div class="row">
    						    <div class="col-md-6">   
    						        <h5 class="text-muted font-weight-medium">Total Win Amount</h5>
    							</div>
    							<div class="col-md-3">
    							    <h5 class="mb-0" id="total_win_amt"><i class="bx bx-rupee"></i>'.$winning_amount.'</h5>
    							</div>
    							<div class="col-md-3 text-sm-right">
    							    <button type="button" class="btn btn-primary waves-light btn-xs" onclick="OpenWinHistoryDetails();" id="winner_btn">View</button>
    						    </div>
    						</div>
    					</div>
    					<div class="bid_history_area">';
    					    if($loss){
        					    $html .= '<div class="bid_history_box bhb_lose_amt">
        					        <div class="row">
        					            <div class="col-md-6">
        					                <h5 class="text-muted font-weight-medium" id="profit_loss">Total Loss Amount</h5>
        					            </div>
    					                <div class="col-md-3">
    					                    <h5 class="mb-0" id="total_profit_amt">
    					                        <i class="bx bx-rupee"></i>'.$amount.'
    					                    </h5>
    					                </div>
        					        </div>';
        			            }else{
        			             $html .= '
        			             <div class="bid_history_box bhb_win_amt">
        			                <div class="row">
        			                    <div class="col-md-6">
        			                        <h5 class="text-muted font-weight-medium" id="profit_loss">Total Profit Amount</h5>
        			                    </div>
            			                <div class="col-md-3">
                			                <h5 class="mb-0" id="total_profit_amt">
                			                    <i class="bx bx-rupee"></i>'.$amount.'
                			                </h5>
                			            </div>
            			            </div>
            			         </div>';
        			            }
        			           $html .= ' </div>
    			        </div>
    			    </div>
    				<div class="col-md-6">';
    				    if($loss){
    				        $html .= '<div class="smile_box"><img src="http://kalyanmumbaimatka.com/adminassets/images/sad.png"></div>';
    				    }else{
    				        $html .= '<div class="smile_box"><img src="http://kalyanmumbaimatka.com/adminassets/images/smile.png"></div>';
    				    }
    			 $html .= '</div> 
    			</div>';
        return response()->json(['success' => 'data get ', 'data' => $html]);
    } catch (\Throwable $e) {
        \DB::rollback();
        return response()->json(['error' => $e->getMessage() . ' on line ' . $e->getLine()]);
    }
       
    }
    
    function getGameNumber2($type){
        
        $digit = [];
        if($type =='single-digit'){
	        $digit = config('constants.single-digit');
	        
	    }else if($type =='jodi-digit'){
	        $digit = config('constants.jodi-digit');
	        
	    }else if($type =='single-panna'){
	        $digit = config('constants.single-pana');
	       
	    }else if($type =='double-panna'){
	        $digit = config('constants.double-pana');
	      
	    }else if($type =='triple-panna'){
	        $digit = config('constants.tripple-pana');
	        
	    }else if($type =='half-sangam'){
	        if($session == 'open'){
	            $digit = config('constants.single-digit');
	        }else{
	            $digit = config('constants.panna');
	        }
	    }else if($type =='full-sangam'){
	        $digit = config('constants.panna');
	       
	    }
	    return $digit;
    }
    
    public function customerSellReport(Request $request)
        {
            $gameNameList = GameName::pluck('name','id');
            $bidHistory = Winner::with('user','gameName');
            if($request->bid_type != 'all-type'){
                $bidHistory->where('bid_type',$request->bid_type);
            }
            $bidHistory->where('game_id',$request->game_id);
            if(!empty($request->bid_date)){
                $bid_date = $request->bid_date;
            }else{
                $bid_date = date('Y-m-d');
            }
            $bidHistory->whereDate('created_at',$bid_date);
            $bidHistory = $bidHistory->get();
            // dd($bidHistory);
            return view('backend.reports.customer-sell-report',compact('gameNameList','request'));
        }
        
        
        public function transferPointReport(Request $request)
        {
            $gameNameList = GameName::pluck('name','id');
            $bidHistory = Winner::with('user','gameName');
            if($request->bid_type != 'all-type'){
                $bidHistory->where('bid_type',$request->bid_type);
            }
            $bidHistory->where('game_id',$request->game_id);
            if(!empty($request->bid_date)){
                $bid_date = $request->bid_date;
            }else{
                $bid_date = date('Y-m-d');
            }
            $bidHistory->whereDate('created_at',$bid_date);
            $bidHistory = $bidHistory->get();
            // dd($bidHistory);
            return view('backend.reports.transfer-point-report',compact('gameNameList','request'));
        }
        
        
        public function withdrawReport(Request $request)
        {
            $data = WalletTransaction::where('type','0');
            
            if(!empty($request->bid_date)){
                $bid_date = $request->bid_date;
            }else{
                $bid_date = date('Y-m-d');
            }
            
            $data->whereDate('created_at',$bid_date);
            
            $data = $data->get()->map(function($data){
                $data->user = User::find($data->user_id);
                return $data;
            });
            
            if(!empty($request->bid_date)){
                $bid_date = $request->bid_date;
            }else{
                $bid_date = date('Y-m-d');
            }
            
            return view('backend.reports.withdraw-report',compact('request','data'));
        }
        
        public function autoDepositeHistory(Request $request)
        {
            
            $gameNameList = GameName::pluck('name','id');
            $bidHistory = Winner::with('user','gameName');
            if($request->bid_type != 'all-type'){
                $bidHistory->where('bid_type',$request->bid_type);
            }
            $bidHistory->where('game_id',$request->game_id);
            if(!empty($request->bid_date)){
                $bid_date = $request->bid_date;
            }else{
                $bid_date = date('Y-m-d');
            }
            $bidHistory->whereDate('created_at',$bid_date);
            $bidHistory = $bidHistory->get();
            
            return view('backend.reports.auto-deposite-history',compact('gameNameList','request'));
        }
        
}
