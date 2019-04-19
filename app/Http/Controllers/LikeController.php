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
    	if(!$status->alreadyLikedByUser()){
    		$status->likes()->create(['user_id' =>Auth::user()->id]);
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
