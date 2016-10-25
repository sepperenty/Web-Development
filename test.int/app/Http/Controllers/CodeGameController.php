<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Third_period_answer;

class CodeGameController extends Controller
{
	  public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(Request $request)
    {
    	if(Auth()->user()->hasNotSubmittedCode())
    	{
    		$newAnswer = new Third_period_answer();
    		$newAnswer->answer = $request->code;
    		Auth()->user()->third_period_answer()->save($newAnswer);
    		return redirect('/home');
    		//message submitted
    	}

    	else
    	{
    		//Error message cant upload 2 codes
    		return redirect('/home');
    	}
    }
}
