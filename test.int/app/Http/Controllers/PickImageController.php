<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Requests;

class PickImageController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

}
