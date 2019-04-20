<?php

namespace Social\Http\Controllers;

use Illuminate\Http\Request;
use Social\Status;
use Social\Like;
use Auth;

class LikeController extends Controller
{
    public function statusLike($statusToLike)
    {
    	$status = Status::where('id',$statusToLike)->firstOrFail();
        $liker = Auth::user();
        $friends = Auth::user()->friends();
    	if(!$status->alreadyLikedByUser()){            
    		$status->likes()->create(['user_id' =>Auth::user()->id]);
            foreach($friends as $friend)
            {
                $friend->notify(new \Social\Notifications\LikedStatus($liker, $status));
            }             
    		return redirect()->back();
    	}
    	else{            
    		return redirect()->back()->with('info','You have already liked this post');
    	}
    	
    }

    public function statusUnlike($statusToLike)
    {
        $like = Like::where(['likeable_id'=>$statusToLike, 'user_id' => Auth::user()->id])->firstOrFail();
        $like->delete();
            return redirect()->back();
    }
}
