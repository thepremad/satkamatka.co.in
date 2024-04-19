<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoublePana;
use App\Models\JodiDigit;
use App\Models\SingleDigit;
use App\Models\SinglePana;
use App\Models\TripplePana;
use App\Models\MainSetting;
use App\Models\ReferralMaster;
use App\Models\ContactSetting;
use App\Models\ValueMaster;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    
    function mainSetting (){
        $main_setting = MainSetting::first();
        $bank_detail = isset($main_setting->bank_detail) ? $main_setting->bank_detail :'';
        $bank_detail = json_decode($bank_detail);
        
        $app_link = isset($main_setting->app_link) ? $main_setting->app_link :'';
        $app_link = json_decode($app_link);
        
        $upi_ids= isset($main_setting->upi_ids) ? $main_setting->upi_ids :'';
        $upi_ids = json_decode($upi_ids);
        
        $app_maintainence= isset($main_setting->app_maintainence) ? $main_setting->app_maintainence :'';
        $app_maintainence = json_decode($app_maintainence);
        
        $ReferralMaster = ReferralMaster::first();
        $ValueMaster = ValueMaster::first();
        
        // print_r($app_link);die;
        return view('backend.settings.main-setting',compact('bank_detail','app_link','upi_ids','app_maintainence','ReferralMaster','ValueMaster'));
    }
    
    function storeBank(Request $request){
        
        $bank_data = [
            'holder_name' => $request->bank_holder_name,
            'account_number' => $request->bank_account_number,
            'ifsc_code' => $request->bank_ifsc_code
            ];
            $data = MainSetting::first();
            if(!empty($data)){
                MainSetting::where('id',$data->id)->update(['bank_detail' => json_encode($bank_data)]);
            }else{
                MainSetting::create(['bank_detail' => json_encode($bank_data)]);
            }
        return redirect()->back()->with('success','Bank Save SuccessFully');
    }
    
    function storeAppLink(Request $request){
        $app_data = [
            'app_link' => $request->app_link,
            'app_share_message' => $request->app_share_message,
            'referral_share_message' => $request->app_referral_share_message,
            ];
            
            $data = MainSetting::first();
            if(!empty($data)){
                MainSetting::where('id',$data->id)->update(['app_link' => json_encode($app_data)]);
            }else{
                MainSetting::create(['app_link' => json_encode($app_data)]);
            }
        return redirect()->back()->with('success','Bank Save SuccessFully');
    }
    
    function storeAppMaintainence(Request $request){
        $buttion = 'No';
        if(isset($request->open_or_close)){
            $buttion = 'Yes';
        }
        $app_data = [
            'share_message' => $request->share_message,
            'show_message' => $buttion,
            ];
        $data = MainSetting::first();
        if(!empty($data)){
            MainSetting::where('id',$data->id)->update(['app_maintainence' => json_encode($app_data)]);
        }else{
            MainSetting::create(['app_maintainence' => json_encode($app_data)]);
        }
           return redirect()->back()->with('success','Bank Save SuccessFully');
    }
    
    function storeUpies(Request $request){
        $app_data = [
            'google' => $request->google_upi_id,
            'phone_pe' => $request->phone_pe_upi_id,
            'other' => $request->other_upi_id,
            ];
        $data = MainSetting::first();
        if(!empty($data)){
            MainSetting::where('id',$data->id)->update(['upi_ids' => json_encode($app_data)]);
        }else{
            MainSetting::create(['upi_ids' => json_encode($app_data)]);
        }
        return redirect()->back()->with('success','Bank Save SuccessFully');
    }
    
    function storeReferralMaster(Request $request){
        $data = [
            'first_bonus_percentage' => $request->first_bonus_percentage,
            'first_bonus_max_amount' => $request->first_bonus_max_amount,
            'remaining_bonus_percentage' => $request->remaining_bonus_percentage,
            'remaining_bonus_max_amount' => $request->remaining_bonus_max_amount,
            ];
            
        
        $check = ReferralMaster::first();
        if(!empty($check)){
            ReferralMaster::where('id',$check->id)->update($data);
        }else{
            ReferralMaster::create($data);
        }
        return redirect()->back()->with('success','Bank Save SuccessFully');
    }
    
    function StoreValues (Request $request){
        $data = $request->all();
        $data['global_batting'] = '0';
        if(isset($request->global_batting)){
            $data['global_batting'] = '1';
        }
        unset($data['_token']);
        
        $check = ValueMaster::first();
        if(!empty($check)){
            ValueMaster::where('id',$check->id)->update($data);
        }else{
            ValueMaster::create($data);
        }
        return redirect()->back()->with('success','Bank Save SuccessFully');
    }
    
    function contactSetting(){
        $data = ContactSetting::first();
        return view('backend.settings.contact-setting',compact('data'));
    }
    
    function contactSettingStore(Request $request){
        $data = $request->all();
        unset($data['_token']);
        $check = ContactSetting::first();
        if(!empty($check)){
            ContactSetting::where('id',$check->id)->update($data);
        }else{
            ContactSetting::create($data);
        }
        return redirect()->back()->with('success','Data Save SuccessFully');
    }
    public function howToPlay(){
        return view('backend.settings.how-to-play');
    }
    public function sliderImages(){
        $slider_image = MainSetting::first();
        if(!empty($slider_image->slider_images)){
            $data = json_decode($slider_image->slider_images);
        }else{
            $data = [];
        }
        return view('backend.settings.slider-images',compact('data'));
        
    }
    public function saveSliderImages(Request $request){
        // Validate the incoming request
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_names = [];
        // Handle each uploaded image
        foreach ($request->file('images') as $image) {
            // Store the image in the public/uploads directory
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $image_names[] = $imageName;
            // You can save the image details to a database if needed
            // Example: Image::create(['name' => $imageName, 'path' => 'uploads/'.$imageName]);
        }
        
        $data = MainSetting::first();
        if(!empty($data->slider_images)){
            $notice_board = json_decode($data->slider_images);
            $data_merge = array_merge($notice_board,$image_names);
        }else{
            $data_merge = $image_names;
        }
        if(!empty($data)){
                MainSetting::where('id',$data->id)->update(['slider_images' => json_encode($data_merge)]);
        }else{
            MainSetting::create(['slider_images' => json_encode($data_merge)]);
        }
        return back()->with('success', 'Images uploaded successfully.');
    }
    public function saveinstructions(Request $request){
     dd($request->all());
    }
    public function sliderList(){
         $slider_image = MainSetting::first();
        if(!empty($slider_image->slider_images)){
            $data = json_decode($slider_image->slider_images);
        }else{
            $data = [];
        }
        return view ('backend.settings.slider-list',compact('data'));
    }
    
    
    public function rules_noticeboard(){
        $data = MainSetting::first();
        if(!empty($data->notice_board)){
            $notice_board = json_decode($data->notice_board);
        }else{
            $notice_board = "";
        }
        
        if(!empty($data->rules)){
            $rules = json_decode($data->rules);
        }else{
            $rules = "";
        }
        
         if(!empty($data->marquee_notification)){
            $marquee_notification = $data->marquee_notification;
        }else{
            $marquee_notification = "";
        }
        
        return view ('backend.settings.rules_noticeboard',compact('notice_board','rules','marquee_notification'));
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
    
    public function rules_notice_board_save(Request $request){
        if(!empty($request->notice_board)){
            $data = MainSetting::first();
            if(!empty($data)){
                MainSetting::where('id',$data->id)->update(['notice_board' => json_encode($request->notice_board)]);
            }else{
                MainSetting::create(['notice_board' => json_encode($request->notice_board)]);
            }
            return redirect()->back()->with('success','Notice board save successfully');
        }elseif(!empty($request->rules)){
            $data = MainSetting::first();
            if(!empty($data)){
                MainSetting::where('id',$data->id)->update(['rules' => json_encode($request->rules)]);
            }else{
                MainSetting::create(['rules' => json_encode($request->rules)]);
            }
            return redirect()->back()->with('success','Rules save successfully');
        }elseif(!empty($request->marquee_notification)){
           $data = MainSetting::first();
            if(!empty($data)){
                MainSetting::where('id',$data->id)->update(['marquee_notification' => $request->marquee_notification]);
            }else{
                MainSetting::create(['marquee_notification' => $request->marquee_notification]);
            }
            return redirect()->back()->with('success','Marquee Notification save successfully');
        }
        
        
        
        
        
    }
    
    
    public function delete_slider_image($key){
        $data = MainSetting::first();
        $images = json_decode($data->slider_images);
      
        $new_image = [];
        
        foreach($images as $keys => $val){
            
            if($keys != $key){
               $new_image[] = $val; 
            }
        }
        
        if(!empty($data)){
                MainSetting::where('id',$data->id)->update(['slider_images' => json_encode($new_image)]);
        }else{
            MainSetting::create(['slider_images' => json_encode($new_image)]);
        }
        return redirect()->back()->with('success','Image delete successfully');
    }
    
    
    
    
    
}
