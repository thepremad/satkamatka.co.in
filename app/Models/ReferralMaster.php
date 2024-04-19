<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralMaster extends Model
{
    use HasFactory;
    
    protected $fillable = ['first_bonus_percentage','first_bonus_max_amount','remaining_bonus_percentage','remaining_bonus_max_amount'];
}
