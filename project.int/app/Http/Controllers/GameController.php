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

    /*
        In deze functie wordt beslist welke game er gestpeeld mag worden.
        Eerst word dat huidige datum opgevraagt en dan wordt er gekeken in de databank met welke
        wedstrijd dit overeenkomt.
        Als er geen enkele data met overeenkomt wordt de gebruiker terug gestuurd naar de home pagina.
    */

    public function index()
    {
        //$thisDate = date("Y-m-d");
        $thisDate = "2016-10-28";
       

        $beerGame = Game::where('name', 'AmountBeerGame')->first();
        $pictureGame = Game::where('name', 'PictureGame')->first();
        $codeGame = Game::where('name', 'CodeGame')->first();
        $pickImageGame = Game::where('name', 'pickImageGame')->first();

        $message = session('message');
  

        if(($beerGame) && ($thisDate>=$beerGame->start) && ($thisDate <= $beerGame->end) )
        {
             return view('games/amountBeerGame/index', compact('beerGame','message'));
        }

        else if( ($pictureGame) && ($thisDate>=$pictureGame->start) && ($thisDate <= $pictureGame->end)  )
        {
            $pictures = Second_period_answer::orderBy("created_at", "desc")->simplePaginate(24);
            return view('games/pictureGame/index', compact('pictureGame', 'pictures','message'));
        }

        else if( ($codeGame) && ($thisDate>=$codeGame->start) && ($thisDate <= $codeGame->end)  )
        {
            return view('games/codeGame/index', compact('codeGame','message'));
        }

        else if( ($pickImageGame) && ($thisDate>=$pickImageGame->start) && ($thisDate <= $pickImageGame->end)  )
        {
            return view('games/pickImageGame/index', compact('pickImageGame','message'));
        }

        else
        {
            return redirect('/');
        }
        
    }
}
