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

        /*
            Met de add functie kan de gebruiker een nieuw antwoord aanmaken voor het 3de spel.
            Met de functie hasNotSubmittedCode wordt gecontroleerd of de user al een antwoord heeft verstuurd.
            Als hij al een antwoord heeft, wrodt hij terug gestuurd naar de game pagina.
        */

    public function add(Request $request)
    {
        $this->validate($request, [
            'code' => 'required | max:50',

            ]);

    	if(Auth()->user()->hasNotSubmittedCode())
    	{
            try{

            $newAnswer = new Third_period_answer();
            $newAnswer->answer = $request->code;
            $newAnswer->ip = $request->ip();
            Auth()->user()->third_period_answer()->save($newAnswer);
            $request->session()->flash('message', "Je code is succesvol verstuurd.");
            return redirect('/game');

            }catch(Exception $e)
            {
            $request->session()->flash('message', "Er is iets misgelopen. We lossen het zo snel mogelijk op.");
            return redirect('/game');
            }

    	}

    	else
    	{
    		$request->session()->flash('message', "Je kan maar 1 code per persoon versturen.");
    		return redirect('/game');
    	}
    }
}
