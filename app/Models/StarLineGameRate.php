<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarLineGameRate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'single_betting_amount', 'single_winning_amount',
        'single_pana_betting_amount', 'single_pana_winning_amount',
        'double_pana_betting_amount', 'double_pana_winning_amount',
        'tripple_pana_betting_amount', 'tripple_pana_winning_amount'
    ];
}
