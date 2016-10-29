<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\http\UploadedFile;
use Illuminate\view\middleware\ShareErrorsFromSession;
use App\UploadPicture;
use App\Second_period_answer;
use App\Http\Requests;

class PictureGameController extends Controller
{
	  public function __construct()
    {
        $this->middleware('auth');
    }

    

	public function add(Request $request)
	{	
		$this->validate($request, [
			'picture' => 'required | max:5000 | mimes:jpeg,bmp,png',
			
			]);

		if($request->hasFile('picture'))
		{
			$newName = rtrim(base64_encode(md5(microtime())), '=');

			$pictureUploader = new UploadPicture($request->picture, $newName);

			$pictureUploader->store();

			$newAnswer = new Second_period_answer();

			$newAnswer->picture = $newName;

			$newAnswer->ip = $request->ip();

			Auth()->user()->second_period_answer()->save($newAnswer);

			$request->session()->flash('message', "Je foto is succesvol geupload.");

			return redirect('/game');
		}
	}

	public function vote(Second_period_answer $picture, Request $request)
	{
		if(Auth()->user()->hasNotVoted())
		{
			if(Auth()->user()->id != $picture->user_id)
			{
				$votes = $picture->votes+1;

				$picture->update([
					'votes' => $votes,
					]);
				Auth()->user()->update([
					"has_voted" => $picture->id,
					]);

				$request->session()->flash('message', "Je vote is opgeslagen.");

				return redirect("/game");
			}

			else
			{
				$request->session()->flash('message', "Je kan niet op je eigen foto voten.");
				return redirect("/game");
			}
			
		}

		else
		{
			$request->session()->flash('message', "Je kan maar 1 keer voten per account.");
			return redirect("/game");
		}
		
	}

}
