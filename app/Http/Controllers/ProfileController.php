<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Social\User;
use Auth;

class ProfileController extends Controller
{
    public function getProfile($email)
    {
    	$user = User::where('email',$email)->firstOrFail();
    	return view('profile.index', compact('user'));
    }

    public function edit()
    {
    	return view('profile.edit');
    }

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