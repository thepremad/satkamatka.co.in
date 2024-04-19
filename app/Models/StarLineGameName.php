<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarLineGameName extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'name',
        'name_hindi',
        'today_open_time',
        'status',
        'market_status',
    ];

    protected function todayOpenTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  date("h:i A", strtotime($value)),            
        );
    }
}
