<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    //

    public function ticket()
    {
        return view('helpdesk.ticket');
    }
}
