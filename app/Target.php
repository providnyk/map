<?php

namespace App;

use App\Model;

class Target extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'published',
	];
	public $a_form = [
	];

	public function point()
	{
		return $this->belongsToMany('App\Point');
	}
}
