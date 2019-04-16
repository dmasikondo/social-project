<?php

namespace Social;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'location', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFirstNameOrEmail()
    {
        return ucwords($this->first_name) ? : $this->email;
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('Social\User', 'friends','user_id', 'friend_id');
    }

    public function friendsOf()
    {
        return $this->belongsToMany('Social\User', 'friends','friend_id', 'user_id');
    }    

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)
            ->get()
            ->merge($this->friendsOf()->wherePivot('accepted', true)
            ->get());
    }

    /**
     * user's friend requests
     * @return Social\User;
     */
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }
    /**
     * friend requests sent by user that have not yet been responded to
     * @return Social\User;
     */
    public function friendRequestsPending()
    {
        return $this->friendsOf()->wherePivot('accepted', false)->get();
    }
    /**
     * check whether the current user has a pending friendship request from this other user
     * @param  User    $user 
     * @return boolean  
     */
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id',$user->id)->count();
    }

    /**
     * check whether a friendship request has been received from this other user
     * @param  User    $user 
     * @return boolean  
     */
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id',$user->id)->count();
    }   
    /**
     * add a friend request
     * @param User $user
     */
    public function addFriend(User $user) 
    {
        return $this->friendsOf()->attach($user->id);
    }
    /**
     * accept the friend request
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function acceptFriendRequest(User $user)
    {
        return $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
                'accepted' => true,
        ]);
    }
    /**
     * check if user is friends with a particular user
     * @param  User    $user [description]
     * @return boolean       [description]
     */
    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id',$user->id)->count();
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}
