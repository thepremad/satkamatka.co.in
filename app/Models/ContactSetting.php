<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;
    
    protected $fillable = ['mobile','telegram_mobile','whatsapp_number','landline_1','landline_2','email_1','email_2','facebook','twiter','youtube','google_plus','instagram','latitude','longitude','address'];
}
