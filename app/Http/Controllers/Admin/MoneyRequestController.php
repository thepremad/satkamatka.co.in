<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoneyRequest;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class MoneyRequestController extends Controller
{
    function dashboard(){
        return view('backend.dashboard');
    }

    function MoneyRequest(){
       $data = MoneyRequest::orderBy('id','DESC')->where('type','0')->get();
        foreach($data as $key=>$val){
            $val['name']   = isset(User::where('id',$val->user_id)->first()->name) ? User::where('id',$val->user_id)->first()->name :'';
            $val['mobile']   = isset(User::where('id',$val->user_id)->first()->mobile) ? User::where('id',$val->user_id)->first()->mobile :'';
        }

        // echo $data;die;
       return view('backend.money-requests.index',compact('data'));
    }
    
    function MoneyWithdrawalRequest (){
        $data = MoneyRequest::orderBy('id','DESC')->where('type','1')->get();
        foreach($data as $key=>$val){
            $val['name']   = isset(User::where('id',$val->user_id)->first()->name) ? User::where('id',$val->user_id)->first()->name :'';
            $val['mobile']   = isset(User::where('id',$val->user_id)->first()->mobile) ? User::where('id',$val->user_id)->first()->mobile :'';
        }

        // echo $data;die;
       return view('backend.money-requests.index-withdrawal',compact('data'));
    }

    function Approve($id){
        $data = MoneyRequest::where('id',$id)->first();
        if($data->type == '1'){
            $credit_bal = WalletTransaction::where(['user_id' => $data->user_id ,'type' => WalletTransaction::$credit])->sum('amount');
            $debit_bal = WalletTransaction::where(['user_id' => $data->user_id ,'type' => WalletTransaction::$debit])->sum('amount');
            $balance = $credit_bal - $debit_bal;
            // $balance = $balance - $data->amount;
            
            if($balance > $data->amount){
                WalletTransaction::create(['user_id' => $data->user_id ,'amount' => $data->amount ,'desc' => 'Money Request withdrawal From Wallet' ,'type' => WalletTransaction::$debit]);
                MoneyRequest::where('id',$id)->update(['status'=> MoneyRequest::$approved]);
            }else{
                $this->Reject($id);
            }
        }else{
            WalletTransaction::create(['user_id' => $data->user_id ,'amount' => $data->amount ,'desc' => 'Money Request Added Into Wallet' ,'type' => WalletTransaction::$credit]);
            MoneyRequest::where('id',$id)->update(['status'=> MoneyRequest::$approved]);
        }
        
        return redirect()->back()->with('success','Approve Approved Success');
    }

    function Reject($id){
        MoneyRequest::where('id',$id)->update(['status'=> MoneyRequest::$reject]);
        return redirect()->back()->with('success','Request Approved Success');
    }
}
