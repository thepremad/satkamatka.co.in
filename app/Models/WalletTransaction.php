<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' ,'amount','type','desc','payment_method','net_balance','game_id','upi_name','winning_id','str_winning_id'];

    static $debit = '0';
    static $credit = '1';
    
    public function gameName(){
        return $this->belongsTo(GameName::class,'game_id');
    }
}
