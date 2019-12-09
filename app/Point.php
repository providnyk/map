<?php

namespace App;

use App\Model;

class Point extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'design_id',
		'published',
		'lat',
		'lng',
	];

	public function designs()
	{
		return $this->belongsToMany('App\Design');
	}

	public function groups()
	{
		return $this->belongsToMany('App\Group');
	}
}
