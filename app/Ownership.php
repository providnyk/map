<?php

namespace App;

use App\Model;

class Ownership extends Model
{

	protected $connection = 'psc';
	protected $fillable = [
		'published',
	];
	public $a_form = [
	];

}
