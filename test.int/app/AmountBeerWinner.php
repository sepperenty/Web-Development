<?php

namespace App;

use Mail;

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

        // $winners = First_period_answer::where('is_winner', 1)->get();

        // Mail::send('mails.newWinner', ['winners' => $winners], function($m)use($winners){
        //     $m->from('hetlo@app.be', 'jupilerWinner');
        //     $m->to('sepperenty@hotmail.com', "sepperenty")->subject('There is a winner');
        // });




    }


   
  

}