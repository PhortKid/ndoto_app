<?php

namespace App\Http\Controllers;
use App\Models\Wallet;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

       $mywallet=Wallet::where('user_id',Auth::user()->id)->first();

        return view('dashboard.index',compact('mywallet'));
    }
}
