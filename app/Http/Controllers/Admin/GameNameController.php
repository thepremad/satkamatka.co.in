<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameName;
use App\Http\Requests\StoreGameNameRequest;
use App\Http\Requests\UpdateGameNameRequest;
use App\Models\GameRate;
use App\Models\GameTime;
use Illuminate\Http\Request;

class GameNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GameName::all();
        return view('backend.gamenames.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.gamenames.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameNameRequest $request)
    {
        $validatedData = $request->validated();
        $gameName = GameName::create($validatedData);
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $openTime = $request->today_open_time;
        $closeTime = $request->today_close_time;
    
        foreach($daysOfWeek as $day) {
            GameTime::create([
                'game_name_id' => $gameName->id, 
                'day_of_week' => $day, 
                'open_time' => $openTime,
                'close_time' => $closeTime
            ]);
        }
        return redirect()->route('admin.gamenames.index')->with('success', 'Game created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GameName $gameName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameName $data,$id)
    {
        $data = GameName::find($id);
        return view('backend.gamenames.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameNameRequest $request, GameName $gameName,$id)
    {        
        $validatedData = $request->validated();

        $data = GameName::find($id);
        $data->update($validatedData);

        return redirect()->route('admin.gamenames.index')->with('success', 'Game updte successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameName $gameName,$id)
    {
        GameName::where('id',$id)->delete();
        return redirect()->back()->with('success','Delete gamename successfully');
    }

    function getGameDays(Request $request){
        try {
            
            // print_r($request->all());die;
        $gameTime = GameTime::whereGameNameId($request->game_name_id)->get();
        $html = '';
        $csrf = csrf_field();  // Generating csrf field
        $html .= '<form class="theme-form" action="'.route("admin.update_game_day").'" method="post">'.$csrf;
        $html .= '
        <div class="row">
            <input type="hidden" id="game_name_id" name="game_name_id" value="'.$request->game_name_id.'">';
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        foreach($daysOfWeek as $day) {
            $gameTimeForDay = $gameTime->firstWhere('day_of_week', $day);
            
            
            // echo $gameTimeForDay;die;
            $isChecked = ($gameTimeForDay !== null) ? 'checked' : '';
            $openTime = ($gameTimeForDay !== null) ? $gameTimeForDay->open_time : '10:00';
            $closeTime = ($gameTimeForDay !== null) ? $gameTimeForDay->close_time : '06:00';

            $html .= '<div class="form-group col-3">
                <input type="checkbox" name="'.$day.'" '.$isChecked.' value="'.$day.'">
                <label>'.ucfirst($day).'</label><br>
            </div>
            <div class="form-group col-4"> <label for="open_time">Open Time</label>
                <input name="'.$day.'_open_time" class="form-control digits"
                    type="time" value="'.$openTime.'">
            </div>
            <div class="form-group col-4"> <label for="close_time">Close Time</label>
                <input name="'.$day.'_close_time"  class="form-control digits"
                    type="time" value="'.$closeTime.'">
            </div>';
        }

        $html .= '<div class="form-group col-12">
            <button type="submit" class="btn btn-primary waves-light m-t-10" >Submit</button>
        </div>
        <div class="form-group">
            <div id=""></div>
        </div>
        </form>';
        return response()->json(['success' => 'data get ', 'data' => $html]);
    } catch (\Throwable $e) {
        \DB::rollback();
        return response()->json(['error' => $e->getMessage() . ' on line ' . $e->getLine()]);
    }
       
    }

    public function updateGameDay(Request $request) {           
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];    
        foreach($daysOfWeek as $day) {
            if($request->has($day)) {
                // Find or create a new GameTime entry for this day of week
                $gameTime = GameTime::firstOrNew([
                    'game_name_id' => $request->game_name_id,
                    'day_of_week' => $day
                ]);
    
                // Update the open and close times
                $gameTime->open_time = $request->input("{$day}_open_time");
                $gameTime->close_time = $request->input("{$day}_close_time");
    
                // Save the game time entry
                $gameTime->save();
            } else {
                // If this day of week is not checked in the form, delete the GameTime entry if it exists
                GameTime::where([
                    'game_name_id' => $request->game_name_id,
                    'day_of_week' => $day
                ])->delete();
            }
        }    
        return redirect()->back()->with('status', 'Game times updated successfully!');
    }
    
    public function geteGameRate()
    {
        $gameRate = GameRate::first();
        return view('backend.gamerates.edit',compact('gameRate'));
    }

    public function updateGameRate(Request $request, $id)
    {
        
        $request->validate([
            'single_betting_amount' => 'required|integer|min:0',
            'single_winning_amount' => 'required|integer|min:0',
            'jodi_betting_amount' => 'required|integer|min:0',
            'jodi_winning_amount' => 'required|integer|min:0',
            'single_pana_betting_amount' => 'required|integer|min:0',
            'single_pana_winning_amount' => 'required|integer|min:0',
            'double_pana_betting_amount' => 'required|integer|min:0',
            'double_pana_winning_amount' => 'required|integer|min:0',
            'tripple_pana_betting_amount' => 'required|integer|min:0',
            'tripple_pana_winning_amount' => 'required|integer|min:0',
            'half_sangam_betting_amount' => 'required|integer|min:0',
            'half_sangam_winning_amount' => 'required|integer|min:0',
            'full_sangam_betting_amount' => 'required|integer|min:0',
            'full_sangam_winning_amount' => 'required|integer|min:0',
        ]);
                
        $gameRate = GameRate::findOrFail($id);
        $gameRate->update($request->all());
        return redirect()->back()->with('status', 'Game rates updated successfully!');
    }
}
