<?php

namespace App;
use Mail;
use App\Third_period_answer;
use App\First_period_answer;
class CodeGameWinner
{

	public function __contstruct()
    {
    	
    }

    /*
        Deze klasse zoekt de winner van de 3de wedstrijd.
        Deze checkt welke antwoorden overeenkomen met de juiste code.
        De antwoorden met de juiste code worden geupdate naar is_winner = 1;
        Op het einde wordt een mail gestuurd naar de admin met de gegevens van de winnaar.
    */

    public function getWinner()
    {
        $realCode = "1111";

    	$answers = Third_period_answer::all();

            foreach ($answers as $contribution) {
                if($contribution->answer == $realCode)
                {
                    $contribution->update(['is_winner' => 1,]);
                }
            }

        $winners = Third_period_answer::where('is_winner', 1)->get();

        $period = 3;

        Mail::send('mails.newWinner', ['winners' => $winners, 'period' => $period], function($m)use($winners,$period){
             $m->from('jupiler@wedstrijd.be', 'jupiler winnaar');
             $m->to('rentyseppe@gmail.com', "sepperenty")->subject('There is a winner');
         });

    }

}
