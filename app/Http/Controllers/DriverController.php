<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersAccounts;
use \App\Modules; 
use Illuminate\Support\Facades\Auth;
class DriverController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driversdata['modules']=Modules::all();
        $driversdata['usersaccounts']=UsersAccounts::all();
        return view('deck.driver',compact('driversdata'));
    }

    public function createDatabase(Request $request){

    }

}
