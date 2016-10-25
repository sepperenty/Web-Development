<?php

namespace App;

use App\First_period_answer;

class AmountBeerWinner
{

    public function __contstruct()
    {
    	
    }

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




    }


   
  

}