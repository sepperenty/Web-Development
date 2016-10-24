<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use app\First_period_answer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


     public function first_period_answer()
     {
        return $this->hasOne(First_period_answer::class);
     }

     public function hasNoBeerAnswer()
     {
        $beerAnswer = DB::table('first_period_answers')->where('user_id', $this->id)->first();

        if($beerAnswer == null)
        {
            return true;
        }

        else
        {
            return false;
        }

     }


}
