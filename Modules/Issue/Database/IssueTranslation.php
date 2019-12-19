<?php

namespace Modules\Issue\Database;

use Illuminate\Database\Eloquent\Model;
#use App\Model;

class IssueTranslation extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'description',
	];
}
