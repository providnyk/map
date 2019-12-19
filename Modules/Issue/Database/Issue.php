<?php

namespace Modules\Issue\Database;

use App\Model;

class Issue extends Model
{
	protected $connection = 'pr';
	protected $fillable = [
		'published',
	];
	public function points()
	{
		return $this->hasMany('App\Point');
	}
}
