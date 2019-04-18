<?php

namespace Social;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	protected $table = 'likeable';
	/**
	 * the variables that are mass assignable
	 * @var array
	 */
    protected $fillable = [
    	'user_id',
    ];

    /**
     * Get all of the likeable models
     * 
     */
    public function likeable()
    {
    	return $this->morphTo();
    }

}
