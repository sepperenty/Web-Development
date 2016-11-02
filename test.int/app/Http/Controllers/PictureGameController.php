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

    /*
		Met deze functie kan de gebruiker een antwoord opslagen voor de 2de wedstrijd.
		Eerst wordt gecontroleerd of de user al een antwoord heeft verstuurd met de hasNoUpload methode.
		Dit met gehulp van de UploadPicture klasse. De naam van de foto foto wordt gegeneereerd adhv de datum.
		

    */
    

	public function add(Request $request)
	{	
		$this->validate($request, [
			'picture' => 'required | max:5000 | mimes:jpeg,bmp,png',
			
			]);

		if(Auth()->user()->hasNoUpload())
		{
			if($request->hasFile('picture'))
			{
				try{

				$newName = rtrim(base64_encode(md5(microtime())), '=');

				$pictureUploader = new UploadPicture($request->picture, $newName);

				$pictureUploader->store();

				$newAnswer = new Second_period_answer();

				$newAnswer->picture = $newName . "." .$request->picture->extension();

				$newAnswer->ip = $request->ip();

				Auth()->user()->second_period_answer()->save($newAnswer);

				$request->session()->flash('message', "Je foto is succesvol geupload.");

				return redirect('/game');
				}catch(Exception $e)
				{
				$request->session()->flash('message', "Er is iets misgelopen. We lossen het zo snel mogelijk op.");
				return redirect("/game");
				}
				
			}
		}
		else
		{
				$request->session()->flash('message', "Je kan maar 1 foto uploaden.");
				return redirect("/game");
		}

		
	}

	/*
		Met deze functie kan je voten op een foto. 
		Met de hasNotVoted wordt er gecheckt of je al gevote hebt.
		Bij de votes row van de afbeelding wordt 1 opgeteld.
	*/

	public function vote(Second_period_answer $picture, Request $request)
	{
		if(Auth()->user()->hasNotVoted())
		{
			if(Auth()->user()->id != $picture->user_id)
			{
				try{
					$votes = $picture->votes+1;

				$picture->update([
					'votes' => $votes,
					]);
				Auth()->user()->update([
					"has_voted" => $picture->id,
					]);

				$request->session()->flash('message', "Je stem is opgeslagen.");

				return redirect("/game");
				}catch(Exception $e)
				{
					$request->session()->flash('message', "Er is iets misgelopen. We lossen het zo snel mogelijk op.");

					return redirect("/game");
				}
				
			}

			else
			{
				$request->session()->flash('message', "Je kan niet op je eigen foto stemmen.");
				return redirect("/game");
			}
			
		}

		else
		{
			$request->session()->flash('message', "Je kan maar 1 keer stemmen per account.");
			return redirect("/game");
		}
		
	}

}
