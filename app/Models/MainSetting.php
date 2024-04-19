<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSetting extends Model
{
    use HasFactory;
    
    protected $fillable = ['bank_detail','app_maintainence','upi_ids','app_link'];
}
