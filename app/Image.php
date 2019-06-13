<?php

namespace Social;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table = 'imageable';
	/**
	 * the variables that are mass assignable
	 * @var array
	 */	
	protected $fillable =[
		'name',
		'isprofile',
	];

	/*public function user()
	{
		return $this->belongsTo(User::class);
	}*/

	public function imageable()
	{
		return $this->morphTo();
	}
    
}
