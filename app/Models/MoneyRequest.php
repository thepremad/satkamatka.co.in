<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','amount','status','type','transaction_id','payment_status','payment_method'];

    static $pending = '0';
    static $approved = '1';
    static $reject = '2';
}
