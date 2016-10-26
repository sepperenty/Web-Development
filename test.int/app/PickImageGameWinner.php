<?php

namespace App;

use App\Fourth_period_answer;

class PickImageGameWinner
{

    public function __contstruct()
    {
    	
    }

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


    }
}




