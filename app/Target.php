<?php

namespace App;

use App\Model;

class Target extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'published',
	];
	public $a_form = [
	];

	public function points()
	{
		return $this->belongsToMany('App\Point');
	}
}
