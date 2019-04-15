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
        return $this->first_name ? : $this->email;
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
}
