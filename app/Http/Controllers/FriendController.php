<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FriendController extends Controller
{
    public function index()
    {
    	$friends = Auth::user()->friends();
    	return view('friends.index', compact('friends'));
    }
}
