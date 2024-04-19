<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
  
Route::fallback(function () {
    return response()->json([
        'ResponseCode'  => 404,
        'status'        => False,
        'message'       => 'URL not found as you looking'
    ]);
});//->name('api.unauthorized');
// sendVoip

Route::post('user_delete',[AuthController::class,'userDelete']);


Route::get('unauthorized', function () {
    return response()->json(['statusCode' => 401, 'status' => 'unauthorized', 'message' => 'Unauthorized user.']);
})->name('api.unauthorized');

/*
        |--------------------------------------------------------------------------
        | AUTH REGISTER LOGIN SENT LOGIN OTP ROUTE
        |--------------------------------------------------------------------------
        */
        Route::controller(AuthController::class)->group(function () {
            Route::post('login', 'login');
            Route::post('user_register', 'register');            
            Route::post('login_otp_verify', 'loginOtpVerify');
            Route::any('profile','profile');    
        });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(AuthController::class)->group(function(){
            Route::post('update_profile','updateUserProfile');    
            // Route::get('profile','getUserProfile');    
            Route::get('get_language','getLanguage');    
            Route::get('get_topic','getTopic');    
            Route::post('update_topic','updateTopic');    
            Route::get('get_my_topic','getMyTopic');    
            Route::get('delete_my_account', 'deleteMyAccount');
            Route::get('get_notifications', 'getNotification');
            Route::get('clearNotification', 'clearNotification');
            Route::get('get_ratting', 'getRatting');
            Route::post('change_visible_status', 'changeVisibleStatus');
            Route::post('save_ratting', 'saveRatting');
            Route::get('find_my_match_connection','findMyMatchConnection');
            Route::post('sent_device_token','sentDeviceToken');
            Route::get('call_history','callHistory');
            Route::get('version', 'version');
           
        
        });

        
    });

    
//  Route::group(['middleware' => 'auth:sanctum'], function () {
    
    Route::controller(GameNameController::class)->group(function(){
        Route::post('get_all_game','getAllGame');
        Route::post('create_bid','createBid');
        Route::post('create_sangam_bid','createSangamBid');
        Route::post('add_money_request','addMoneyRequest');
        Route::post('my_money_request','mymoneyRequest');
        Route::post('my_wallet','myWallet');
        Route::post('bid_History','bidHistory');
        Route::post('winner_history','WinnerHistory');
        Route::post('get_game_number','getGameNumber');
        Route::post('withdrawal','withdrawal');
        Route::post('transaction_history','transactionHistory');
        Route::post('save_bank_detail','saveBankDetail');
        Route::post('get_bank_detail','getBankDetail');
        Route::get('main_setting','settings');
        Route::post('get_dptpsp_panna','spDpGetNumber');
        Route::post('ge_two_digpan','geTwoDigPannel');
        Route::post('get_panel_group','getPannelGroup');
        Route::get('get_top_players','getTopPlayers');
        Route::post('send_otp','sendOtp');
        Route::post('verify_otp','verifyOtp');
        Route::post('set_password','setPassword');
    });
    
    Route::group(['prefix'=>'starline'],function(){
        Route::controller(StarLineGameNameController::class)->group(function(){
            Route::post('get_all_game','getAllGame');
            Route::post('create_bid','createBid');
            Route::post('bid_History','bidHistory');
            Route::post('winner_history','WinnerHistory');
            Route::post('get_game_number','getGameNumber');
        });    
    });

// });