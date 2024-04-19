<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
            'user_id',
            'type',
            'acccount_holder_name',
            'acccount_number',
            'ifsc_code',
            'bank_name',
            'branch_address',
            'upi_id',
            'upi_type'
        ];
}
