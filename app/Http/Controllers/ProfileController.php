<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Social\User;
use Auth;
use Image;

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
        $image = Auth::user()->images()->where('isprofile', true)->latest()->limit(1)->get();
    	return view('profile.edit', compact('image'));
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
            'image' => 'sometimes|file|image|max:200',
    	]);

    	$user = Auth::user()->update([
    		'first_name' => request()->firstname,
    		'last_name' => request()->lastname,
    		'location' =>request()->location,
    	]);

        if(request()->hasFile('image')){
            $filename = request()->image->getClientOriginalName();
            $new_filename = uniqid().$filename;
            $avatar = 'avatar'.$new_filename;
            $avatarpath= (storage_path().'/app/public/avatar/'.$avatar);
            request()->image->move(storage_path().'/app/public/uploads',$new_filename);
            copy((storage_path().'/app/public/uploads/'.$new_filename), (storage_path().'/app/public/avatar/'.$avatar));
            $img =Image::make(fopen(storage_path().'/app/public/avatar/'.$avatar, 'r+'))->fit(25,25);
            $img->save($avatarpath);
            Auth::user()->images()->create([
                'name' => $new_filename,
                'isprofile' => true,
            ]);
            $user = Auth::user(); 
            //$photo = $avatar;       
            $friends = Auth::user()->friends();
            foreach($friends as $friend)
            {
                $friend->notify(new \Social\Notifications\UpdatedProfileimage($user, $avatar));
            }             
        } 

    	return redirect()->route('user-profile.edit')->with('info','Your profile was successfully updated');
    	
    }

}
