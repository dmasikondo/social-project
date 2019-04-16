<?php

namespace Social;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
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
}
