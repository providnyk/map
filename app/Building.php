<?php

namespace App;

use App\Model;

class Building extends Model
{

	protected $connection = 'psc';
	protected $fillable = [
		'published',
	];
	public $a_form = [
	];

}
