<?php

namespace App;

use App\Model;

class Ownership extends Model
{

	protected $connection = 'pr';
	protected $fillable = [
		'published',
	];
	public $a_form = [
	];

}
