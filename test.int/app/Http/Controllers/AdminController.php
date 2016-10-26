<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\First_period_answer;
use App\Second_period_answer;
use App\Third_pepriod_answer;
use App\Fourth_period_answer;

class AdminController extends Controller
{
    
       public function __construct()
    {
        $this->middleware('admin');
    }


    public function manage()
    {

    	$users = User::simplePaginate(15);
    	$users->load('First_period_answer', 'Second_period_answer', 'Third_period_answer', 'Fourth_period_answer');
    	return view('admin.manage', compact('users'));
    }

    public function delete(User $user)
    {
    	$user->delete();
    	return redirect('/manage');
    }
}
