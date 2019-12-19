<?php

namespace App;

 use Illuminate\Database\Eloquent\Model;


class IssueTranslation_1 extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'description',
	];
}
