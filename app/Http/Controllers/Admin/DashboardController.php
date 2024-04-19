<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameName;
use App\Models\GameResult;
use App\Models\GameBid;
use App\Models\MoneyRequest;
use App\Models\WalletTransaction;
use App\Models\User;
use App\Models\TopPlayer;
use Carbon\Carbon;

use App\Traits\ResponseWithHttpRequest;

class DashboardController extends Controller
{
    use ResponseWithHttpRequest;

    function dashboard(){
        
        
//         // Get the counts of bids per game_number value
// $counts = GameBid::selectRaw('game_number, COUNT(*) as count')
//                   ->where('bid_type','single-digit')
//                  ->groupBy('game_number')
//                  ->pluck('count', 'game_number')
//                  ->toArray();

// // Fill in missing values with 0
// for ($i = 0; $i <= 9; $i++) {
//     if (!isset($counts[$i])) {
//         $counts[$i] = 0;
//     }
// }

// // Sort the counts by game_number
// ksort($counts);
// dd($single_digit_counts);


        
//     $bidCounts = GameBid::select('game_number', \DB::raw('count(*) as count'))
//                         ->where('bid_type','single-digit')
//                         ->groupBy('game_number')
//                         ->get();

//     // Organize the results into an associative array for easy access
//     $bidCountsPerType = [];
//     foreach ($bidCounts as $bid) {
//         $bidCountsPerType[$bid->game_number] = $bid->count;
//     }

//     dd($bidCountsPerType);
    
        $money_request = MoneyRequest::where('type', '0')
            ->where('status', '0')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->whereDate('created_at',date('Y-m-d'))
            ->get();
        //   echo $money_request;die;  
            
        foreach($money_request as $key=>$val){
            $val['name']   = isset(User::where('id',$val->user_id)->first()->name) ? User::where('id',$val->user_id)->first()->name :'';
            $val['mobile']   = isset(User::where('id',$val->user_id)->first()->mobile) ? User::where('id',$val->user_id)->first()->mobile :'';
        }
        $gameNameList = GameName::get();
        $total_game = GameName::count();
        $customers = User::where('role_id','2')->count();
        $today_bid = GameBid::whereDate('created_at',date('Y-m-d'))->sum('point_quantity');
        
        $un_athorised_user = User::where('status','!=','1')->count();
        $athorised_user = User::where('status','1')->count();
        return view('backend.dashboard', compact('gameNameList','money_request','customers','total_game','today_bid','athorised_user','un_athorised_user'));
    }
    
    // function getTodaySingleDigitBit(Request $request){
    //     $today = Carbon::now();
    //     $single_digit_counts = GameBid::selectRaw('game_number, COUNT(*) as count')
    //               ->where('bid_type','single-digit')
    //               ->where('game_id',$request->game_id)
    //               ->whereDate('created_at',$today)
    //               ->where('session', $request->session)
    //               ->groupBy('game_number')
    //               ->pluck('count', 'game_number')
    //               ->toArray();

    //     // Fill in missing values with 0
    //     for ($i = 0; $i <= 9; $i++) {
    //         if (!isset($single_digit_counts[$i])) {
    //             $single_digit_counts[$i] = 0;
    //         }
    //     }
    //     // Sort the counts by game_number
    //     ksort($single_digit_counts);
    //     $html_content = '';
    //         foreach($single_digit_counts as $key => $val):
    //             $html_content .=  '<div class="col-md-2">
    //                     <div class="card card-developer-meetup" style="border: 1px solid #a55970;">
    //                         <div class="card-body">
    //                             <div class="align-items-center" style="    text-align: center;"> 
    //                                 <div class="my-auto">
    //                                     <h4 class="card-title mb-25">Total Bid '. $val .'</h4>
    //                                     <p class="card-text mb-0">Total Bid Amount</p>
    //                                     <div>
    //                                         <span>Ank '. $key .'</span>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>';
    //         endforeach;      
            
    //         return response()->json(['status' => true,'data' => $html_content]);
    // }
    
    function getTodaySingleDigitBit(Request $request){
        $array = [];
        for($i= 0; $i<10 ;$i++){
            $game_total_bid_amount = GameBid::whereDate('created_at',date('Y-m-d'))->where('game_id',$request->game_id)->where('bid_type','single-digit')->where('game_number',$i)->where('session',$request->session_type)->sum('point_quantity');
            $game_count = GameBid::whereDate('created_at',date('Y-m-d'))->where('game_id',$request->game_id)->where('bid_type','single-digit')->where('game_number',$i)->where('session',$request->session_type)->count();
            $array[] = ['number' => $i , 'count' => $game_count ,'sum_amount' => $game_total_bid_amount];
        }
        return response()->json(['status' => true,'data' => $array]);
    }
    
    
    function get_game_market_value(Request $request){
        return GameBid::whereDate('created_at',date('Y-m-d'))->where('game_id',$request->game_id)->sum('point_quantity');
    }
    
    function bidRevert(Request $request){
        $gameNameList = GameName::get();
       
        
        
        $bid_date = isset($request->bid_date) ? $request->bid_date :date('Y-m-d');
        $game_id = isset($request->game_id) ? $request->game_id :'';
        
        
        if(!empty($game_id)){
            $bid_data = GameBid::whereDate('created_at',$bid_date)->where('game_id',$game_id)->get();  
        }else{
            $bid_data = [];
        }
        
        foreach($bid_data as $key=>$val){
            $val['user_name'] = isset(User::where('id',$val->user_id)->first()->name) ? User::where('id',$val->user_id)->first()->name :'';
            $val['user_mobile'] = isset(User::where('id',$val->user_id)->first()->mobile) ? User::where('id',$val->user_id)->first()->mobile :'';
        }
        
        $return_Data = ['bid_date' => $bid_date ,'game_id' => $game_id];
        return view('backend.bid-revert',compact('gameNameList','return_Data','bid_data'));
    }
    
    function bid_clear_for_rebert (Request $request){
        $bid_data = GameBid::whereDate('created_at',$request->date)->where('game_id',$request->game_id)->delete();  
        $bid_data = WalletTransaction::whereDate('created_at',$request->date)->where('game_id',$request->game_id)->delete();  
        return redirect()->back()->with('success','Bid Rebert Successfully');
    }
    
    function topPlayers_list(){
        $data = TopPlayer::get()->map(function($top){
            if(empty($top->image)){
                $top->image = 'download.png';
            }
            $game =  GameName::find($top->game_id);
            $top->name_name = isset($game->name) ? $game->name :'';
            return $top;
        });  
        return view('backend.top_players.index',compact('data'));
    }
    
    function topPlayersCreate(){
        $game = GameName::orderBy('name','desc')->get();
        return view('backend.top_players.create',compact('game'));
    }
    
    function topPlayerStore(Request $request){
        $data =   [
                'name' => $request->name,
                'digit' => $request->digit,
                'amount' => $request->amount,
                'time' => $request->time,
                'game_id' => $request->game_id,
        ];
        if($request->hasFile('image')) {
            $image = $request->image;
            $image_name = time().rand(1,100).'-'.$image->getClientOriginalName();
            $image_name = preg_replace('/\s+/', '', $image_name);
            $image->move(public_path('images/'), $image_name);
            
            $data['image'] = $image_name;
        }
    
        
        if($request->id){
            TopPlayer::where('id',$request->id)->update($data);
            return redirect()->route('admin.top_players.index')->with('success','Player update successfully');    
        }else{
            TopPlayer::create($data);
            return redirect()->route('admin.top_players.index')->with('success','Player create successfully');    
        }
    }
    
    function topPlayerDelete($id){
        TopPlayer::where('id',$id)->delete();
        return redirect()->route('admin.top_players.index')->with('success','Player delete successfully');
    }
    
    function topPlayerEdit($id){
        $player = TopPlayer::where('id',$id)->first();
        $game = GameName::orderBy('name','desc')->get();
        return view('backend.top_players.edit',compact('game','player'));
    }
    
    
}
