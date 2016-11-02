<?php

namespace App;

use Mail;

use App\First_period_answer;

class AmountBeerWinner
{

    public function __contstruct()
    {
    	
    }

    /*
        Deze klasse zoekt de winnaar van de eerste wedstrijd.
        De eerste foreach neemt het absolute verschil tusse het juiste antwoord en het ingegeven antwoord.
        Het laagste verschil wordt opgeslagen.
        De tweede foreach update de antwoorden met het juiste antwoord naar is_winner=1;
        Op het einde wordt er een mail gestuurd naar de admin met de informatie over de winnaar.
    */

    public function getWinner()
    {
    	$closestAnswer = 1000;
        $exactAnswer = 20;
        $answers = First_period_answer::all();
       	

    	foreach ($answers as $possisbleAnswer) {

                $newDifferrence = abs($exactAnswer - $possisbleAnswer->answer);
   
                    if($newDifferrence < $closestAnswer)
                    {
                         $closestAnswer = $newDifferrence;       
                    }
                
    		}

    	foreach ($answers as $possisbleAnswer) {
                
                $difference = abs($exactAnswer - $possisbleAnswer->answer);

                    if($difference == $closestAnswer)
                    {
                        echo 'ja';
                        $possisbleAnswer->update([
                            "is_winner" => 1
                        ]);
                    }

    		}

        $winners = First_period_answer::where('is_winner', 1)->get();
        $period = 1;

         Mail::send('mails.newWinner', ['winners' => $winners, 'period' => $period], function($m)use($winners,$period){
             $m->from('jupiler@wedstrijd.be', 'jupiler winnaar');
             $m->to('rentyseppe@gmail.com', "sepperenty")->subject('There is a winner');
         });




    }


   
  

}