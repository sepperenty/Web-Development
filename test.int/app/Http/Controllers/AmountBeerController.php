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

    /*
        Met de add functie kan een user een nieuw antwoord genereren voor het eerste spel.
        Eerst wordt gecontroleerd met behulp van hasNoBeerAnswer() om te kijken of de user al een
        antwoord heeft. 
        Als hij al een antwoord heeft wordt hij terug gestuurd naar de game pagina.

    */


    public function add(Request $request)
    {
        $this->validate($request, [
            'answer' => 'required | max:50',

            ]);

    	if(Auth()->user()->hasNoBeerAnswer())
    	{
            try{

    		$newAnswer = new First_period_answer;

	    	$newAnswer->answer = $request->answer;

            $newAnswer->ip = $request->ip();

	   		Auth()->user()->first_period_answer()->save($newAnswer);

            $request->session()->flash('message', "Je Antwoord is succesvol verstuurd.");

	   		return redirect('/game');
            }catch(Exception $e){
                $request->session()->flash('message', "Er is iets misgelopen. We lossen het zo snel mogelijk op.");
                return redirect('/game');
            }
    	}

    	else
    	{
            $request->session()->flash('message', "Je kan maar 1 antwoord versturen.");

    		return redirect('/game');
    	}

    }

   
}
