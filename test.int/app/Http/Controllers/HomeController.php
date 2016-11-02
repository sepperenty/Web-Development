<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\User;
use App\First_period_answer;
use App\Second_period_answer;
use App\Third_period_answer;
use App\Fourth_period_answer;

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

    /*
        Deze funcite opent de homepagina en geeft de winnaars van elke wedstrijd mee als deze er zijn.
    */

    public function index()
    {
        $winners1 = First_period_answer::where('is_winner',1)->get();
        $winners2 = Second_period_answer::where('is_winner', 1)->get();
        $winners3 = Third_period_answer::where('is_winner', 1)->get();
        $winners4 = Fourth_period_answer::where('is_winner', 1)->get();

        return view("home", compact('winners1', 'winners2', 'winners3', 'winners4'));
        
    }
}
