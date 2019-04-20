<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Social\Status;
use Social\User;

class StatusController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * show all the Status by the user
     */
    
    public function index($usermail)
    {
        $user = User::where('email',$usermail)->firstOrFail();
        $statuses = $user->statuses()->notReply()->paginate(3);
         return view('pages.home',compact('statuses'));
    }
    /**
     * show requested status
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showStatus($id)
    {
        $status = Status::where('id',$id)->firstOrFail();
        return view('timeline.show',compact('status'));
    }    
	/**
	 * Store a newly created status in storage
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
	 */
    public function postStatus(Request $request)
    {
    	$this->validate($request,['timeline' => 'required']);
    	$status = Auth::user()->statuses()->create(['body' =>request()->timeline]);
        $poster = Auth::user();
        $friends = Auth::user()->friends();
        foreach($friends as $friend)
        {
            $friend->notify(new \Social\Notifications\PostedStatus($poster, $status));
        }        
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
        $replier = Auth::user();
        $friends = Auth::user()->friends();
    	$reply = Auth::user()->statuses()->create(['body' =>request("reply-{$statusId}")]);
    	$status->replies()->save($reply);
        foreach($friends as $friend)
        {
            $friend->notify(new \Social\Notifications\RepliedStatus($replier, $status));
        }        
    	return redirect()->back()->with('info','Reply successfully updated');
    }

}
