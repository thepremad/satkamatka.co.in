<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\NoticeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('home',[AdminAuthController::class, 'index'])->name('home');

Route::name('admin.')->group(function () {
    Route::middleware('guest')->group(
        function () {
            Route::get('/', [AdminAuthController::class, 'index']);
            Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
            Route::post('/login', [AdminAuthController::class, 'login']);
        }
    );

    /*
    |--------------------------------------------------------------------------
    |AUTHENTIC ROUTE
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {
        
        
        Route::get('delete-declare-result/{id}',[DeclareResultController::class,'deleteResult'])->name('delete-declare-result');
        
        
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/dashboard',  'dashboard')->name('dashboard');
            Route::post('getTodaySingleDigitBit',  'getTodaySingleDigitBit')->name('get_today_sdingle_digit_bit');
        });
        
        Route::resource('gamenames', GameNameController::class);
        
        Route::resource('users', UserController::class);
        Route::controller(UserController::class)->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('unapproved', 'unApproved')->name('users.unapproved');
                Route::post('status/toggle', 'toggleStatus')->name('users.toggel_status');
                Route::post('betting/toggle', 'toggleBetting')->name('users.toggle_betting');
                Route::post('transfer/toggle', 'toggleTransfer')->name('users.toggle_transfer');
                Route::post('add-wallet','addWalletAmount')->name('users.add-wallet');
            });
        });
        
        Route::controller(GameNameController::class)->group(function () {
            Route::post('get_game_days', 'getGameDays')->name('get_game_days');
            Route::post('update_game_day', 'updateGameDay')->name('update_game_day');
            Route::get('game-rates', 'geteGameRate')->name('game-rates');
            Route::post('update-game-rates/{id}', 'updateGameRate')->name('update-game-rates');
        });

        Route::name('starline.')->group(function () {
            Route::resource('starline_gamenames', StarLineGameNameController::class);
            Route::controller(StarLineGameNameController::class)->group(function () {
                Route::post('starline-get_game_days', 'getGameDays')->name('get_game_days');
                Route::post('starline-update_game_day', 'updateGameDay')->name('update_game_day');
                Route::get('starline-game-rates', 'geteGameRate')->name('game-rates');
                Route::post('starline-update-game-rates/{id}', 'updateGameRate')->name('update-game-rates');
            });
            
            Route::get('starline_delete-declare-result/{id}',[StarLineDeclareResultController::class,'deleteResult'])->name('delete-declare-result');
            
            // Route::controller(StarLineGameNumberController::class)->group(function () {
            //     Route::get('starline-single-digit', 'singleDigit')->name('single-digit');
            //     Route::get('starline-jodi-digit', 'jodiDigit')->name('jodi-digit');
            //     Route::get('starline-single-pana', 'singlePana')->name('single-pana');
            //     Route::get('starline-double-pana', 'doublePana')->name('double-pana');
            //     Route::get('starline-tripple-pana', 'tripplePana')->name('tripple-pana');
            // });
            
            
            Route::controller(StarLineDeclareResultController::class)->group(function () {
                Route::get('starline-declare-result', 'declareResult')->name('declare-result');
                Route::post('starline-result-declare', 'resultDeclare')->name('result-declare');
                Route::get('starline-result-declare-get_game_name', 'resultDeclareGameName')->name('result.get_game_name'); 
                Route::post('starline-get-game-winning-bid-detail','getGameWinningDetails')->name('get-game-winning-bid-detail');
                Route::post('starline-get-edit-bid','editBid')->name('edit-bid');
                
                
            });
            
            Route::controller(StarLineReportController::class)->group(function () {
            Route::get('starline-user-bid-history','userBidHistory')->name('user-bid-history');
            
            Route::get('starline-user-result-history','resultHistory')->name('result-history');
            Route::get('starline-user-sell-report','sellReport')->name('sell-report');
            Route::get('starline-user-winning-report','winningReport')->name('winning-report');
            Route::get('starline-user-winning-predecting','winningReport')->name('winning-predecting');
            
            Route::post('starline-get_bid_details','getBidDetails')->name('get_bid_details');
            Route::post('starline-update_bid','updateBid')->name('update_bid');
            Route::get('starline-winning_report','winningReport')->name('winning_report');
            Route::get('starline-bid-winning-report','bidWinningReport')->name('bid_winning_report');
            Route::post('starline-get-bid-winning-report-details','getBidWinningReportDetails')->name('get_bid_winning_report_details');
            
            // Route::get('customer-sell-report','customerSellReport')->name('customer_sell_report');
            // Route::get('transfer-point-report','transferPointReport')->name('transfer_point_report');
            // Route::get('withdraw-report','withdrawReport')->name('withdraw_report');
            // Route::get('auto-deposite-history','autoDepositeHistory')->name('auto_deposite_history');
            
            
            
            
        });
             
        });
 
        
            
        Route::controller(GameNumberController::class)->group(function () {
            Route::get('single-digit', 'singleDigit')->name('single-digit');
            Route::get('jodi-digit', 'jodiDigit')->name('jodi-digit');
            Route::get('single-pana', 'singlePana')->name('single-pana');
            Route::get('double-pana', 'doublePana')->name('double-pana');
            Route::get('tripple-pana', 'tripplePana')->name('tripple-pana');
        });
        
        Route::controller(WinningPredictionController::class)->group(function () {
            Route::get('winning-predictions', 'winningPrediction')->name('winning-predictions');
        });
        
        Route::controller(DeclareResultController::class)->group(function () {
            Route::get('declare-result', 'declareResult')->name('declare-result');
            Route::post('result-declare', 'resultDeclare')->name('result-declare');
            Route::get('result-declare-get_game_name', 'resultDeclareGameName')->name('result.get_game_name');
        });

        Route::controller(MoneyRequestController::class)->group(function () {
            Route::get('money-request', 'MoneyRequest')->name('money-request');
            Route::get('money-request-withdrawal', 'MoneyWithdrawalRequest')->name('money-request-withdrawal');
            Route::get('money-request-approved/{id}','Approve')->name('money-request-approve');
            Route::get('money-request-reject/{id}','Reject')->name('money-request-reject');
        });
        
        Route::post('get-game-winning-bid-detail',[DeclareResultController::class,'getGameWinningDetails'])->name('get-game-winning-bid-detail');
        
        Route::controller(SettingController::class)->group(function () {
            Route::get('main-setting','mainSetting')->name('main-setting');
            Route::post('main-setting-store-bank-detail','storeBank')->name('main-setting-store-bank-detail');
            Route::post('main-setting-store-app-link','storeAppLink')->name('main-setting-store-app-link');
            Route::post('main-setting-store-add-maintainence','storeAppMaintainence')->name('main-setting-store-add-maintainence');
            Route::post('main-setting-store-add-upies','storeUpies')->name('main-setting-store-add-upies');
            Route::post('main-setting-store-referral_master','storeReferralMaster')->name('main-setting-store-referral_master');
            Route::post('main-setting-store-values','StoreValues')->name('main-setting-store-values');
            Route::get('slider-images','sliderImages')->name('slider-images');
            Route::post('save-slider-images','saveSliderImages')->name('save-slider-images');
            Route::get('delete_slider_image/{key}','delete_slider_image')->name('delete_slider_image');
            
            Route::get('contact-setting','contactSetting')->name('contact-setting');
            Route::post('contact-setting-store','contactSettingStore')->name('contact-setting-store');
            Route::get('how-to-play','howToPlay')->name('how-to-play');
            Route::post('save-instructions','saveinstructions')->name('save-instructions');
            Route::get('slider-list','sliderList')->name('slider-list');
            Route::get('rules_noticeboard','rules_noticeboard')->name('rules_noticeboard');
            
            Route::post('ckeditor.image-upload','upload')->name('ckeditor.image-upload');
            Route::post('rules_notice_board_save','rules_notice_board_save')->name('rules_notice_board_save');
        });
        
        Route::controller(ReportController::class)->group(function () {
            Route::get('user-bid-history','userBidHistory')->name('user-bid-history');
            Route::post('get_bid_details','getBidDetails')->name('get_bid_details');
            Route::post('update_bid','updateBid')->name('update_bid');
            Route::get('winning_report','winningReport')->name('winning_report');
            Route::get('bid-winning-report','bidWinningReport')->name('bid_winning_report');
            Route::post('get-bid-winning-report-details','getBidWinningReportDetails')->name('get_bid_winning_report_details');
            
            Route::get('customer-sell-report','customerSellReport')->name('customer_sell_report');
            Route::get('transfer-point-report','transferPointReport')->name('transfer_point_report');
            Route::get('withdraw-report','withdrawReport')->name('withdraw_report');
            Route::get('auto-deposite-history','autoDepositeHistory')->name('auto_deposite_history');
             });
        
        Route::post('edit-bid',[DeclareResultController::class,'editBid'])->name('edit-bid');
        Route::post('get_game_market_value',[DashboardController::class,'get_game_market_value'])->name('get_game_market_value');
        
        Route::get('bid-revert',[DashboardController::class,'bidRevert'])->name('bid-revert');
        Route::post('bid_clear_for_rebert',[DashboardController::class,'bid_clear_for_rebert'])->name('bid_clear_for_rebert');
    });
    Route::controller(NoticeController::class)->group(function () {
        Route::get('notice-management','noticeManagement')->name('notice-management');
        Route::post('save-notice-management','saveNoticemanagement')->name('save-notice-management');
       
    });
    
    Route::get('top_players',[DashboardController::class,'topPlayers_list'])->name('top_players.index');
    Route::get('top_players-create',[DashboardController::class,'topPlayersCreate'])->name('top_players.create');
    Route::post('top_players-store',[DashboardController::class,'topPlayerStore'])->name('top_players.store');
    Route::get('top_players-edit/{id}',[DashboardController::class,'topPlayerEdit'])->name('top_players.edit');
    Route::get('top_players-delete/{id}',[DashboardController::class,'topPlayerDelete'])->name('top_players.delete');
    
    Route::post('declare_result_save',[DeclareResultController::class,'declareResultSave'])->name('declare_result_save');
    Route::post('check_is_declare_or_not',[DeclareResultController::class,'check_is_declare_or_not'])->name('check_is_declare_or_not');
    
});
