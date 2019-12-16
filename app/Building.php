<?php

namespace App;

use App\Model;

class Building extends Model
{

	protected $connection = 'pr';
	protected $fillable = [
		'published',
	];

}
