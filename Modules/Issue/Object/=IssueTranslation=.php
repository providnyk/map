<?php

namespace Modules\Issue\Object;

#use Illuminate\Database\Eloquent\Model;
use App\Model;

class IssueTranslation_2 extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'description',
	];
}
