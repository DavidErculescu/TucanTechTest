<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use App\Entities\School;
use Illuminate\Routing\Controller as BaseController;

class PageController extends BaseController
{
    public function home(){
        return view('pages/home');
    }
}