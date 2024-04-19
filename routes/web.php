<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'homePage'])->name('home');
Route::get('jodi/{id}', [HomeController::class, 'jodi'])->name('jodi');
Route::get('panel/{id}', [HomeController::class, 'panel'])->name('panel');

Route::get('home',function(){
    return redirect('/admin/dashboard');
});




Route::get('chart/{id}',[Controller::class,'calendar'])->name('chart');

Route::get('privacy-policy',function(){
    return view('privacy_policy'); 
});
