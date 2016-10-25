<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Game;
use App\AmountBeerWinner;
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
        

        $newDate = "2016-11-02";   

        $AmountBeerGame = Game::where('name', 'AmountBeerGame')->first(); 
        $PictureGame = Game::where('name', 'PictureGame')->first();
        $CodeGame = Game::where('name', 'CodeGame')->first();
        $PickImageGame = Game::where('name', 'PickImageGame')->first();

        $AmountBeerEndDate = ($AmountBeerGame) ? date('Y-m-d', strtotime($AmountBeerGame->end. ' + 1 days')) : 0;
        $PictureGameEndDate = ($PictureGame) ? date('Y-m-d', strtotime($PictureGame->end. ' + 1 days')) : 0;
        $CodeGameEndDate = ($CodeGame) ? date('Y-m-d', strtotime($CodeGame->end. ' + 1 days')) : 0;
        $PickImageGameEndDate = ($PickImageGame) ? date('Y-m-d', strtotime($PickImageGame->end. ' + 1 days')) : 0;

        if($newDate == $AmountBeerEndDate)
        {
            $BeerWinner = new AmountBeerWinner();
            $BeerWinner->getWinner();
            $AmountBeerGame->delete();
            
        }elseif ($newDate == $PictureGameEndDate) {
            
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

            $PictureGame->delete();

        }elseif ($newDate == $CodeGameEndDate) {
            
            $answers = Third_period_answer::all();

            foreach ($answers as $contribution) {
                if($contribution->answer == 15)
                {
                    $contribution->update(['is_winner' => 1,]);
                }
            }

            $CodeGame->delete();


        }elseif($newDate == $PickImageGameEndDate){
            //do something
        }

        
    }
}
