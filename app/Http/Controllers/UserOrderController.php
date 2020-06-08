<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(){
        $userOders = auth()->user()->orders()->paginate(15);
//        error_log('Some message here.');

        return view('user-orders', compact('userOders'));
    }
}
