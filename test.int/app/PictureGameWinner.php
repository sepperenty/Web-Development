<?php

namespace App;

use App\Second_period_answer;

class PictureGameWinner
{

    public function __contstruct()
    {
    	
    }

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
    }
}
