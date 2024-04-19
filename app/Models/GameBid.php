<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameBid extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'user_id',
        'bid_type',
        'game_number',
        'game_number_sangam_close',
        'point_quantity',
        'session',
        'net_balance'
    ];
    
    public function gameName(){
        return $this->belongsTo(GameName::class,'game_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
}
