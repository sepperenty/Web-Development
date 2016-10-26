<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;

use App\First_period_answer;

use App\AmountBeerWinner;

use Illuminate\view\middleware\ShareErrorsFromSession;

class AmountBeerController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(Request $request)
    {
        $this->validate($request, [
            'answer' => 'required | max:225',

            ]);

    	if(Auth()->user()->hasNoBeerAnswer())
    	{
    		$newAnswer = new First_period_answer;

	    	$newAnswer->answer = $request->answer;

            $newAnswer->ip = $request->ip();

	   		Auth()->user()->first_period_answer()->save($newAnswer);

            $request->session()->flash('message', "Je Antwoord is succes verstuurd.");

	   		return redirect('/game');
    	}

    	else
    	{
            $request->session()->flash('message', "Je kan geen meerdere antwoorden versturen.");

    		return redirect('/game');
    	}

    }

   
}
