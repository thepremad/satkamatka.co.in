<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StarLineGameName;
use App\Http\Requests\StoreGameNameRequest;
use App\Http\Requests\UpdateGameNameRequest;
use App\Models\StarLineGameRate;
use App\Models\StarLineGameTime;
use App\Models\StarLineGameBid;
use App\Models\StarLineGameResult;
use App\Models\StarLineWinner;

use Illuminate\Http\Request;

class StarLineReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function userBidHistory(Request $request)
    {
        $gameNameList = StarLineGameName::pluck('name','id');
        
            $bidHistory = StarLineGameBid::with('user','gameName');
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
        return view('backend.reports.starline.user-bid-history',compact('gameNameList','bidHistory','request'));
    }
    
    public function resultHistory(Request $request)
    {
        
        $result = StarLineGameResult::get();
        foreach($result as $key=>$val){
            $val['game_name'] = isset(StarLineGameName::find($val->game_id)->first()->name) ? StarLineGameName::find($val->game_id)->first()->name :'';
        }
        $gameNameList = StarLineGameName::pluck('name','id');
            
        return view('backend.reports.starline.result-history',compact('gameNameList','result','request'));
    }

    function getBidDetails(Request $request) {
    try {
        $bidData = StarLineGameBid::find($request->bid_id);
        
        $html = '';
        $csrf = csrf_field();  // Generating csrf field
        $html .= '<form class="theme-form" action="'.route("admin.starline.update_bid").'" method="post">'.$csrf;
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
        $bidData = StarLineGameBid::find($request->bid_id);
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
            $gameNameList = StarLineGameName::pluck('name','id');
            
                $bidHistory = StarLineWinner::with('user','gameName');
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
            return view('backend.reports.starline.winning-report',compact('gameNameList','bidHistory','request'));
        }
        
     function bidWinningReport(Request $request)
        {
            $gameNameList = GameName::pluck('name','id');
            return view('backend.reports.starline.bid-winning-report',compact('gameNameList'));
        }
        
    function getBidWinningReportDetails(Request $request)
    {
        try {
         $bid_amount =     StarLineGameBid::whereDate('created_at',$request->date)->where('game_id',$request->game_id)->select('game_id',\DB::raw('SUM(point_quantity) AS bid_amount'))->groupBy('game_id')->first();
         $winning_amount =  StarLineWinner::whereDate('created_at',$request->date)->where('game_id',$request->game_id)->select(\DB::raw('SUM(winning_amount) AS winning_amount'))->groupBy('game_id')->first();
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
            $gameNameList = StarLineGameName::pluck('name','id');
            $bidHistory = StarLineWinner::with('user','gameName');
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
            return view('backend.reports.starline.customer-sell-report',compact('gameNameList','request'));
        }
        
        public function sellReport(Request $request)
        {
            $gameNameList = StarLineGameName::pluck('name','id');
            $bidHistory = StarLineWinner::with('user','gameName');
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
            return view('backend.reports.starline.sell-report',compact('gameNameList','request'));
        }
        
        
        public function transferPointReport(Request $request)
        {
            $gameNameList = StarLineGameName::pluck('name','id');
            $bidHistory = StarLineWinner::with('user','gameName');
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
            return view('backend.reports.starline.transfer-point-report',compact('gameNameList','request'));
        }
        
        
        public function withdrawReport(Request $request)
        {
            $gameNameList = StarLineGameName::pluck('name','id');
            $bidHistory = StarLineWinner::with('user','gameName');
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
            return view('backend.reports.starline.withdraw-report',compact('gameNameList','request'));
        }
        
        public function autoDepositeHistory(Request $request)
        {
            $gameNameList = StarLineGameName::pluck('name','id');
            $bidHistory = StarLineWinner::with('user','gameName');
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
            return view('backend.reports.starline.auto-deposite-history',compact('gameNameList','request'));
        }
        
}
