<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DispatcherController extends Controller
{
    public function start(){
        return view('clients.freising.start');
    }
}
