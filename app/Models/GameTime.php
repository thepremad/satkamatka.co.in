<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_name_id',
        'day_of_week',
        'open_time',
        'close_time'
    ];
}
