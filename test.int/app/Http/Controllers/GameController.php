<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;

use App\Second_period_answer;

class GameController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$thisDate = date("Y-m-d");
        $thisDate = "2016-10-24";

        $beerGame = Game::where('name', 'AmountBeerGame')->first();
        $pictureGame = Game::where('name', 'PictureGame')->first();
        $codeGame = Game::where('name', 'CodeGame')->first();
        $pickImageGame = Game::where('name', 'pickImageGame')->first();

        $message = session('message');
  

        if( ($thisDate>=$beerGame->start) && ($thisDate <= $beerGame->end) )
        {
             return view('games/amountBeerGame/index', compact('beerGame','message'));
        }

        else if( ($thisDate>=$pictureGame->start) && ($thisDate <= $pictureGame->end)  )
        {
            $pictures = Second_period_answer::all();
            return view('games/pictureGame/index', compact('pictureGame', 'pictures','message'));
        }

        else if( ($thisDate>=$codeGame->start) && ($thisDate <= $codeGame->end)  )
        {
            return view('games/codeGame/index', compact('codeGame','message'));
        }

        else if( ($thisDate>=$pickImageGame->start) && ($thisDate <= $pickImageGame->end)  )
        {
            return view('games/pickImageGame/index', compact('pickImageGame','message'));
        }

        else
        {
            return view('home');
        }
        
    }
}
