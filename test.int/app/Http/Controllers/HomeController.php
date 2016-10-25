<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

use App\Second_period_answer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $thisDate = date("Y-m-d");
        $thisDate = "2016-10-31";

        $beerGame = Game::where('name', 'AmountBeerGame')->first();
        $pictureGame = Game::where('name', 'PictureGame')->first();
        $codeGame = Game::where('name', 'CodeGame')->first();
        $pickImageGame = Game::where('name', 'pickImageGame')->first();

      

        if( ($thisDate>=$beerGame->start) && ($thisDate <= $beerGame->end) )
        {
             return view('games/amountBeerGame/index', compact('beerGame'));
        }

        else if( ($thisDate>=$pictureGame->start) && ($thisDate <= $pictureGame->end)  )
        {
            $pictures = Second_period_answer::all();
            return view('games/pictureGame/index', compact('pictureGame', 'pictures'));
        }

        else if( ($thisDate>=$codeGame->start) && ($thisDate <= $codeGame->end)  )
        {
            return view('games/codeGame/index', compact('codeGame'));
        }

        else if( ($thisDate>=$pickImageGame->start) && ($thisDate <= $pickImageGame->end)  )
        {
            return view('games/pickImageGame/index', compact('pickImageGame'));
        }

        else
        {
            return view('home');
        }
        
    }
}
