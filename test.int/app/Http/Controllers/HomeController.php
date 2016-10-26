<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

use App\Second_period_answer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view("home");
        
    }
}
