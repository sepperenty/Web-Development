<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Second_period_answer extends Model
{
	use SoftDeletes;
    public function user()
 	{
 		return $this->belongsTo(User::class);
 	} 

 	
 	protected $dates = ["deleted_at"];
}
