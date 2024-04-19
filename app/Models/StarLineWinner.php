<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarLineWinner extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'game_id',
        'user_id',
        'bid_id',
        'game_result_id',
        'bid_type',
        'game_number',
        'point_quantity',
        'session',
        'winning_amount',
        'net_balance',
        'winning_at',
    ];
    
    public function gameName() {
    return $this->belongsTo(StarLineGameName::class, 'game_id');
   }
   
   public function user() {
    return $this->belongsTo(User::class);
   }
}
