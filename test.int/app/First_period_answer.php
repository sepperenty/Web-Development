<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class First_period_answer extends Model
{	
	use SoftDeletes;

	protected $fillable = ["is_winner"];

 	public function user()
 	{
 		return $this->belongsTo(User::class);
 	}   

 	protected $dates = ["deleted_at"];
}
