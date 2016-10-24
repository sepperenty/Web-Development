<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\First_period_answer;

class AmountBeerController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(Request $request)
    {
    	if(Auth()->user()->hasNoBeerAnswer())
    	{
    		$newAnswer = new First_period_answer;

	    	$newAnswer->answer = $request->answer;

	   		Auth()->user()->first_period_answer()->save($newAnswer);

	   		return redirect('/home');
    	}

    	else
    	{
    		return redirect('/home');
    	}

    }
}
