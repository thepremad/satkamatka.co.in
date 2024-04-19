<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BankDetail;
use App\Models\MoneyRequest;
use App\Models\GameBid;
use App\Models\GameName;
use App\Models\Winner;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereRoleId(2)->status(1)->latest()->get();
        foreach($users as $key=>$val){
            $val['current_balance'] = $this->getWalletBalance($val->id);
        }
        return view('backend.users.index',compact('users'));
    }

    public function unapproved()
    {        
        $users = User::whereRoleId(2)->status(0)->latest()->get();
        return view('backend.users.un-approved-list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id',$id)->first();
        $bank_detais = BankDetail::where('user_id',$id)->first();
        $money_requests = MoneyRequest::where('user_id',$id)->where('type','0')->orderBy('id','Desc')->get();
        $withdrawal_requests = MoneyRequest::where('user_id',$id)->where('type','1')->orderBy('id','Desc')->get();
        $bids = GameBid::where('user_id',$id)->latest()->get();
        $user_wallet_credit = WalletTransaction::where('user_id',$id)->where('type','1')->sum('amount');
        $user_wallet_debit = WalletTransaction::where('user_id',$id)->where('type','0')->sum('amount');
        $user['wallet_amount'] = $user_wallet_credit - $user_wallet_debit;
        foreach($bids as $key=>$val){
            $val['game_name'] = isset(GameName::where('id',$val->game_id)->first()->name) ? GameName::where('id',$val->game_id)->first()->name :'';
        }
        $wallet_transactions = WalletTransaction::where('user_id',$id)->orderBy('id','DESC')->get()->map(function($transaction){
            $winner_result = Winner::where('id',$transaction->winning_id)->first();
            if(!empty($winner_result)){
                $game_data = GameName::where('id',$winner_result->game_id)->first();
                $transaction['desc'] = "winning amount [ $game_data->name ,  $winner_result->session - $winner_result->bid_type , $winner_result->game_number]";
            }
            return $transaction;
        });
        
        $winningGames = Winner::where('user_id',$id)->orderBy('id','DESC')->get();
        foreach($winningGames as $key=>$val){
            $val['game_name'] = isset(GameName::where('id',$val->game_id)->first()->name) ? GameName::where('id',$val->game_id)->first()->name :'';
        }
        
        return view('backend.users.show',compact('user','bank_detais','money_requests','bids','wallet_transactions','withdrawal_requests','winningGames'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleStatus(Request $request)
    {
        if (!$request->ajax()) abort('403');
        $user = User::findOrFail($request->get('id'));
        $user->status = $user->status ? 0 : 1;
        $user->save();

    return response()->json(['status' => $user->status]);
    }

    public function toggleBetting(Request $request)
    {
        if (!$request->ajax()) abort('403');
            $user = User::findOrFail($request->get('id'));
        $user->betting = $user->betting ? 0 : 1;
        $user->save();

        return response()->json(['betting' => $user->betting]);
    }

    public function toggleTransfer(Request $request)
    {
        if (!$request->ajax()) abort('403');
            $user = User::findOrFail($request->get('id'));
        $user->transfer = $user->transfer ? 0 : 1;
        $user->save();

        return response()->json(['transfer' => $user->transfer]);
    }
    
    function addWalletAmount(Request $request){
        if($request->type == '1'){
            $type = '1';
            $desc = 'Amount Added by Admin';
            $message = 'Amount Added Success';
        }else{
            $type = '0';
            $desc = 'Amount Withdraw  by Admin';
            $message = 'Amount Withdraw Success';
        }
        WalletTransaction::create(['user_id' => $request->user_id ,'type' => $type ,'desc' => $desc ,'amount' => $request->amount]);
        return redirect()->back()->with('success',$message);
    }
    
    function getWalletBalance($user_id){
        $get_Credit =  WalletTransaction::where('type','1')->where('user_id',$user_id)->sum('amount');
        $get_Debit =  WalletTransaction::where('type','0')->where('user_id',$user_id)->sum('amount');
        return $get_Credit - $get_Debit;
    }


}
