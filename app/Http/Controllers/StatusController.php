<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Social\Status;

class StatusController extends Controller
{
	/**
	 * Store a newly created status in storage
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
	 */
    public function postStatus(Request $request)
    {
    	$this->validate($request,['timeline' => 'required']);
    	Auth::user()->statuses()->create(['body' =>request()->timeline]);
    	return redirect()->route('home')->with('info','Status successfully updated');
    }

    public function postReply(Request $request, $statusId)
    {
    	$this->validate($request, [
    		"reply-{$statusId}" => 'required',
    	],
    		['required' => 'The response cannot be empty'
    	]);

    	$status = Status::notReply()->find($statusId);
    	$reply = Auth::user()->statuses()->create(['body' =>request("reply-{$statusId}")]);
    	//$reply = Status::create(['body' =>request("reply-{$statusId}"),])->user()->associate(Auth::user());
    	$status->replies()->save($reply);
    	return redirect()->route('home')->with('info','Reply successfully updated');

    }
}
