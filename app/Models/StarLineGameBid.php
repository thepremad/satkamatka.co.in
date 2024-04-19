<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarLineGameBid extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'game_id',
        'user_id',
        'bid_type',
        'game_number',
        'point_quantity',
        'session'
    ];
    
    public function gameName(){
        return $this->belongsTo(StarLineGameName::class,'game_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
