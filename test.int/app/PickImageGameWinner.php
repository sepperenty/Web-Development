<?php

namespace App;
use Mail;
use App\Fourth_period_answer;

class PickImageGameWinner
{

    public function __contstruct()
    {
    	
    }

    /*
        Deze klasse zoekt naar de winnaar van de vierde periode.
        Er wordt met de eerste foreach geloopt door de personen die het juiste antwoord op de eerste vraag hebben.
        Het kleinste absolute verschil wordt opgeslagen.
        In de tweede foreach wordt er door de users geloopt en worden de antwoorden met het juiste antwoord geupdate naar
        is_winner = 1;
        Op het einde wordt naar de admin een mail gestuurd met de informatie over de winnaars.
    */

    public function getWinner()
    {
    	$answerReal = 1;
    	$tieBreakerReal = 2000;
    	$rightAnwers = Fourth_period_answer::where("answer", $answerReal)->get();

    	$diffrenceControl = $tieBreakerReal;

    	foreach ($rightAnwers as $answer) {
    		$possisbleBreaker = $answer->tiebreaker;
    		$difference = abs($tieBreakerReal - $possisbleBreaker);

    		if($difference < $diffrenceControl)
    		{
    			$diffrenceControl = $difference;
    		}


    	}

    	foreach ($rightAnwers as $answer) {
    		$possisbleBreaker = $answer->tiebreaker;
    		$difference = abs($tieBreakerReal - $possisbleBreaker);

    		if($difference == $diffrenceControl)
    		{
    			$answer->update([
    				'is_winner'=> 1,
    				]);
    		}
    	}

        $winners = Fourth_period_answer::where('is_winner', 1)->get();
        $period = 4;

         Mail::send('mails.newWinner', ['winners' => $winners, 'period' => $period], function($m)use($winners,$period){
             $m->from('jupiler@wedstrijd.be', 'jupiler winnaar');
             $m->to('rentyseppe@gmail.com', "sepperenty")->subject('There is a winner');
         });


    }
}




