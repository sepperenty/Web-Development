<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\First_period_answer;
use App\Second_period_answer;
use App\Third_period_answer;
use App\Fourth_period_answer;
use Excel;

class AdminController extends Controller
{
    
       public function __construct()
    {
        $this->middleware('admin');
    }


    /*
        De manage functie returnt al de Users en eager load de antwoorden.
        De admin kan hier enkel komen en heeft zo een overzicht over al de gebruikers en hun antwoorden.
    */

    public function manage()
    {

    	$users = User::simplePaginate(15);
    	$users->load('First_period_answer', 'Second_period_answer', 'Third_period_answer', 'Fourth_period_answer');
        $message = session('message');
    	return view('admin.manage', compact('users', 'message'));
    }

    /*
        De delete functie zorgt ervoor dat een gekoze user verwijderd kan worden.
        hierbij worden ook al de gegeven antwoorden van die user verwijderd.
    */

    public function delete(User $user, Request $request)
    {
        try{

        $userAnswer1 = First_period_answer::where('user_id', $user->id)->delete();
        $userAnswer2 = Second_period_answer::where('user_id', $user->id)->delete();
        $userAnswer3 = Third_period_answer::where('user_id', $user->id)->delete();
        $userAnswer4 = Fourth_period_answer::where('user_id', $user->id)->delete();
        $user->delete();
        $request->session()->flash('message', "Account is succesvol verwijderd.");
        return redirect('/manage');

        }
        catch(Exception $e)
        {
        $request->session()->flash('message', "Er is iets mis gelopen. We lossen het zo snel mogelijk op.");
        return redirect('/manage');
        }
    	


    	
    }

    
}

