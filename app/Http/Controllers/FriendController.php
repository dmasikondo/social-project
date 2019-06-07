<?php

namespace Social\Http\Controllers;
//use Illuminate\Notifications\Notifiable;
//use Illuminate\Notifications\Notification\friendRequest;
use Illuminate\Http\Request;
use Auth;
use Social\User;

class FriendController extends Controller
{
   // use Notifiable;
    public function __construct()
    {
        return $this->middleware([
            'auth',
        ]);
    }
	/**
	 * display a list of user's friends
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$friendRequests = Auth::user()->friendRequests();
    	$friends = Auth::user()->friends();
        $query = '';
    	return view('friends.index', compact('friends', 'friendRequests','query'));
    }
    /**
     * add a new friend request in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addFriend($usermail)
    {
    	$user = User::where('email', $usermail)->first();
        $requester = Auth::user();
    	if (!$user)
    	{
    		return redirect()->route('home')->with('info','That user could not be found');
    	}
    	if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
    	{
    		return redirect()->route('home')->with('info','friend request already pending');
    	}

    	if(Auth::user()->isFriendsWith($user))
		{
			return redirect()->route('user-profile',['email'=>$user->email])->with('info','You are already friends');
		}

		if(Auth::user()->id === $user->id)
		{
			return redirect()->route('home');
		}
    	Auth::user()->addFriend($user);
        $user->notify(new \Social\Notifications\FriendRequest($requester));
    	return redirect('/user/'.$user->email)->with('info','Friend request successfully sent');
    }

    public function acceptFriend($usermail)
    {
    	$user = User::where('email', $usermail)->first();
        $accepter = Auth::user();
    	if (!$user)
    	{
    		return redirect()->route('home')->with('info','That user could not be found');
    	}
    	if(!Auth::user()->hasFriendRequestReceived($user)) 
    	{
    		return redirect()->route('home');
    	}  	
    	Auth::user()->acceptFriendRequest($user);
        $user->notify(new \Social\Notifications\AcceptedRequest($accepter));
    	return redirect('/user/'.$user->email)->with('info','You are now friends');
    }

    public function removeFriend($usermail)
    {
        $user = User::where('email', $usermail)->first();
        $user->unFriend(Auth::user());
        Auth::user()->unFriend($user);
        return redirect('/user/'.$user->email)->with('info',"You are nolonger friends with {$user->getFirstNameOrEmail()}");
    }
}
