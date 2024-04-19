<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueMaster extends Model
{
    use HasFactory;
    
    protected $fillable = ['min_deposite','max_deposite','min_withdrawal','max_withdrawal','min_transfer','max_transfer','min_bid_amount','max_bid_amount','welcome_bonus','withdrawal_open_time','withdrawal_close_time','global_batting'];
}
