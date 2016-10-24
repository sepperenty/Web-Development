<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Game;
use App\First_period_answer;
use App\Second_period_answer;
use App\Third_period_answer;
use App\Fourth_period_answer;

class CheckForWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:CheckForWinner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elke nacht checken of het tijd is om de winnaar aan te duiden.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        

        $newDate = "2016-10-27";   

        $AmountBeerGame = Game::where('name', 'AmountBeerGame')->first(); 
        $PictureGame = Game::where('name', 'PictureGame')->first();
        $CodeGame = Game::where('name', 'CodeGame')->first();
        $PickImageGame = Game::where('name', 'PickImageGame')->first();

        $AmountBeerEndDate = date('Y-m-d', strtotime($AmountBeerGame->end. ' + 1 days'));
        $PictureGameEndDate = date('Y-m-d', strtotime($PictureGame->end. ' + 1 days'));
        $CodeGameEndDate = date('Y-m-d', strtotime($CodeGame->end. ' + 1 days'));
        $PickImageGameEndDate = date('Y-m-d', strtotime($PickImageGame->end. ' + 1 days'));

        

        if($newDate == $AmountBeerEndDate)
        {
            $answers = First_period_answer::all();

            $closestAnswer = 1000;
            $exactAnswer = 20;



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
            //do something
        }elseif ($newDate == $PictureGameEndDate) {
            //do something
        }elseif ($newDate == $CodeGameEndDate) {
            //do something
        }elseif($newDate == $PickImageGameEndDate){
            //do something
        }

        
    }
}
