<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoublePana;
use App\Models\JodiDigit;
use App\Models\SingleDigit;
use App\Models\SinglePana;
use App\Models\TripplePana;
use Illuminate\Http\Request;

class GameNumberController extends Controller
{
    public function singleDigit(){
        $singleDigit = SingleDigit::all();
        return view('backend.game_numbers.single_digit',compact('singleDigit'));
    }

    public function jodiDigit(){
        $jodiDigit = JodiDigit::all();
        return view('backend.game_numbers.jodi_digit',compact('jodiDigit'));
    }

    public function singlePana(){
        $singlePana = SinglePana::all();
        return view('backend.game_numbers.single_pana',compact('singlePana'));
    }

    public function doublePana(){
        $doublePana = DoublePana::all();
        return view('backend.game_numbers.double_pana',compact('doublePana'));
    }

    public function tripplePana(){
        $tripplePana = TripplePana::all();
        return view('backend.game_numbers.tripple_pana',compact('tripplePana'));
    }
}
