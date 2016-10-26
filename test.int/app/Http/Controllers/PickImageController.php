<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Fourth_period_answer;

use Illuminate\view\middleware\ShareErrorsFromSession;

class PickImageController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
         $this->validate($request, [
            'bottlePick' => 'required',
            'tiebreaker' => 'required | max:255',

            ]);

    	if (Auth()->user()->hasNotPickedImage()) {
    		
    		$newAnswer = new Fourth_period_answer();
	    	$newAnswer->answer = $request->bottlePick;
	    	$newAnswer->tiebreaker = $request->tiebreaker;
            $newAnswer->ip = $request->ip();
	    	Auth()->user()->fourth_period_answer()->save($newAnswer);
            $request->session()->flash('message', "Je antwoord is succesvol verstuurd!");
	    	return redirect('/game');

    	}
    	else
    	{
    		$request->session()->flash('message', "Je kan maar 1 antwoord per persoon versturen.");
    		return redirect('/game');
    	}

    	
    }

}
