<?php

namespace App;

use App\Model;

class Group extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'published',
	];

	public function points()
	{
		return $this->belongsToMany('App\Point');
	}
}
