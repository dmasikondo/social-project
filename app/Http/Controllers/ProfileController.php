<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Social\User;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
	/**
	 * [getProfile description]
	 * @param  [type] $email [description]
	 * @return [type]        [description]
	 */
    public function getProfile($email)
    {
        $query = '';
    	$user = User::where('email',$email)->firstOrFail();
    	$statuses = $user->statuses()->notReply()->orderBy('created_at','desc')->paginate(2);
    	$authUserIsFriend = $user->isFriendsWith(Auth::user());
    	return view('profile.index', compact('user','statuses','authUserIsFriend','query'));
    }
    /**
     * edit the user profile
     * @return [type] [description]
     */
    public function edit()
    {
    	return view('profile.edit');
    }
    /**
     * update user profile
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request)
    {
    	$this->validate($request,[
    		'firstname' => 'required|alpha',
    		'lastname' => 'required|alpha',
    		'location' => 'required|max:20',
    	]);

    	Auth::user()->update([
    		'first_name' => request()->firstname,
    		'last_name' => request()->lastname,
    		'location' =>request()->location,
    	]);

    	return redirect()->route('user-profile.edit')->with('info','Your profile was successfully updated');
    	
    }

}
