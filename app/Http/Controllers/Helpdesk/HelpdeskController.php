<?php

namespace App\Http\Controllers\Helpdesk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    //

    public function helpdesk(){
        return view('helpdesk.dashboard');
    }
}
