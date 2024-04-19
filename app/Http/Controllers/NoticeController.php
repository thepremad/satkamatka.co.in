<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function noticeManagement(){
        return view('backend.notice-management.notice-management');
    }
    public function saveNoticemanagement(Request $request){
         ($request->all());
    }
}
