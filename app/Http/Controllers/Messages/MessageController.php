<?php
/*
 處理查無資料、資料錯誤等的對應訊息 
 return type: JSON
    msg:string
    statuscode: number
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * @param $request
     * @return JSON
     */
    public function index(Request $request)
    {
    }
}
