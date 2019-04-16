<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
    	$this->validate($request,['timeline' => 'required']);

    	Auth::user()->statuses()->create(['body' =>request()->timeline]);
    	return redirect()->route('home')->with('info','Status successfully updated');
    }
}
