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

    /*
        Met de add functie kan er een nieuw antwoord worden aangemaakt voor de 4de wedstrijd.
        Eerst wordt er met de hasNotPickedImage functie gecontroleerd of hij al een antwoord heeft. 
        Als dit het geval is wordt hij terug gestuurd naar de game pagina.
        Er wordt ook een tiebreaker opgeslagen aangezien het een meerkeuze vraag is.
    */

    public function add(Request $request)
    {
         $this->validate($request, [
            'bottlePick' => 'required',
            'tiebreaker' => 'required | max:50',

            ]);

    	if (Auth()->user()->hasNotPickedImage()) {
    		
            try{
                $newAnswer = new Fourth_period_answer();
            $newAnswer->answer = $request->bottlePick;
            $newAnswer->tiebreaker = $request->tiebreaker;
            $newAnswer->ip = $request->ip();
            Auth()->user()->fourth_period_answer()->save($newAnswer);
            $request->session()->flash('message', "Je antwoord is succesvol verstuurd!");
            return redirect('/game');
        }catch(Exception $e)
        {
            $request->session()->flash('message', "Er is iets misgelopen. We lossen het zo snel mogelijk op.");
            return redirect('/game');
        }
    		

    	}
    	else
    	{
    		$request->session()->flash('message', "Je kan maar 1 antwoord per persoon versturen.");
    		return redirect('/game');
    	}

    	
    }

}
