<?php

namespace Social;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Status extends Model
{
	protected $appends = [
		'countLikes',
	];	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body','parent_id',
    ];	
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    /**
     * not a reply but main status
     */
    public function scopeNotReply($query)
    {
    	return $query->whereNull('parent_id');
    }

    public function replies()
    {
    	return $this->hasMany(Status::class, 'parent_id');
    }
    public function getCountLikesAttribute()
    {
    	return $this->likes->count();
    }
    public function alreadyLikedByUser()
    {
    	if(!Auth::user()){
    		return false;
    	}
    	return (bool) $this->likes()->where('user_id', Auth::user()->id)->count();
    }
    public function likes()
    {
    	return $this->morphMany(Like::class, 'likeable');
    }


}
