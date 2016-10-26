<?php

namespace App;

use App\Third_period_answer;

class CodeGameWinner
{

	public function __contstruct()
    {
    	
    }

    public function getWinner()
    {
    	$answers = Third_period_answer::all();

            foreach ($answers as $contribution) {
                if($contribution->answer == 15)
                {
                    $contribution->update(['is_winner' => 1,]);
                }
            }
    }

}
