<?php

namespace App;

use App\Model;

class Target extends Model
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
