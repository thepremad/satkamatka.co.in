<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopPlayer extends Model
{
    use HasFactory;

    protected $table = 'top_players';
    
    protected $fillable = [
        'game_id','time','amount','digit','image','name'
    ];
    
    
}
