<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnershipTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
	];
}
