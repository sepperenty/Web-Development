<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\First_period_answer;
use App\Second_period_answer;
use App\Third_period_answer;
use App\Fourth_period_answer;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'has_voted',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ["deleted_at"];


        public function first_period_answer()
        {
            return $this->hasOne(First_period_answer::class);
        }

        
        public function second_period_answer()
        {
            return $this->hasOne(Second_period_answer::class);
        }

        public function third_period_answer()
        {
            return $this->hasOne(Third_period_answer::class);
        }

        public function fourth_period_answer()
        {
            return $this->hasOne(Fourth_period_answer::class);
        }

        /*
            Al de functies hieronder worden gebruikt om te checken of iets al dan niet het geval is.
            Bijvoorbeeld isAdmin is om te checken of de User wel degelijk isAdmin=1 heeft.
        */

        public function isAdmin()
        {
            return $this->admin;
        }

        public function hasNoBeerAnswer()
        {
            $beerAnswer = First_period_answer::where('user_id', $this->id)->first();

            if($beerAnswer == null)
            {
                return true;
            }

            else
            {
                return false;
            }

        }



        public function hasNoUpload()
        {
            $upload = Second_period_answer::where('user_id', $this->id)->first();

            if($upload == null)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function hasNotVoted()
        {
            if($this->has_voted)
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        public function hasNotSubmittedCode()
        {
            $possAnswer = Third_period_answer::where('user_id', $this->id)->first();

            if($possAnswer == null)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function hasNotPickedImage()
        {
            $possAnswer = Fourth_period_answer::where('user_id', $this->id)->first();
            if($possAnswer == null)
            {
                return true;
            }
            else
            {
                return false;
            }
        }


}
