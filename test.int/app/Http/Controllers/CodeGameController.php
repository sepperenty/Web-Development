<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Third_period_answer;

use Illuminate\view\middleware\ShareErrorsFromSession;

class CodeGameController extends Controller
{
	  public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(Request $request)
    {
        $this->validate($request, [
            'code' => 'required | max:225',

            ]);

    	if(Auth()->user()->hasNotSubmittedCode())
    	{
    		$newAnswer = new Third_period_answer();
    		$newAnswer->answer = $request->code;
            $newAnswer->ip = $request->ip();
    		Auth()->user()->third_period_answer()->save($newAnswer);
            $request->session()->flash('message', "Je code is succesvol verstuurd ! ");
    		return redirect('/game');
    		//message submitted
    	}

    	else
    	{
    		$request->session()->flash('message', "Je kan maar 1 code per persoon versturen.");
    		return redirect('/game');
    	}
    }
}
