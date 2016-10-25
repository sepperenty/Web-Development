<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\http\UploadedFile;

use App\UploadPicture;
use App\Second_period_answer;
use App\Http\Requests;

class PictureGameController extends Controller
{
    

	public function add(Request $request)
	{	
		$this->validate($request, [
			'picture' => 'max:5000 | mimes:jpeg,bmp,png',

			]);

		if($request->hasFile('picture'))
		{
			$newName = rtrim(base64_encode(md5(microtime())), '=');

			$pictureUploader = new UploadPicture($request->picture, $newName);

			$pictureUploader->store();

			$newAnswer = new Second_period_answer();

			$newAnswer->picture = $newName;

			Auth()->user()->second_period_answer()->save($newAnswer);

			return redirect('/home');
		}
	}

	public function vote(Second_period_answer $picture)
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
					"has_voted" => 1,
					]);

				return redirect("/home");
			}

			else
			{
				//message not vote on your own picture
				return redirect("/home");
			}
			
		}

		else
		{
			//message You have already voted
			return redirect("/home");
		}
		
	}

}
