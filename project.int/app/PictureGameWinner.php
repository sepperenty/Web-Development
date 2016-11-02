<?php

namespace App;
use Mail;
use App\Second_period_answer;

class PictureGameWinner
{

    public function __contstruct()
    {
    	
    }

    /*
        In deze klasse wordt de winnaar van de tweede wedstrijd aangeduid.
        In de eerste foreach wordt het meeste aantal votes vastgesteld.
        In de tweede foreach worden de antwoorden met de meeste aantal votes geupdate naar is_winner = 1.
        Op het einde wordt er een mail gestuurd naar de admin met de informatie over de winnaar.
    */

    public function getWinner()
    {
    	$voteControl = 0;
            $answers = Second_period_answer::all();
            foreach ($answers as $answer) {

                if($answer->votes > $voteControl)
                {

                    $voteControl = $answer->votes;
                }
            }

            foreach ($answers as $answer) {
                if($answer->votes == $voteControl)
                {
                     
                    $answer->update([
                        "is_winner"=>1,
                        ]);
                }
            }

        $winners = Second_period_answer::where('is_winner', 1)->get();
        $period = 2;

         Mail::send('mails.newWinner', ['winners' => $winners, 'period' => $period], function($m)use($winners,$period){
             $m->from('jupiler@wedstrijd.be', 'jupiler winnaar');
             $m->to('rentyseppe@gmail.com', "sepperenty")->subject('There is a winner');
         });
    }
}
