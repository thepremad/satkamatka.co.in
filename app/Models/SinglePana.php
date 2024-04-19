<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinglePana extends Model
{
    use HasFactory;
    protected $fillable = ['digit'];

    public function setDigitAttribute($value)
    {
        $this->attributes['digit'] = json_encode($value);
    }

    public function getDigitAttribute($value)
    {
        return json_decode($value);
    }

}
