<?php

namespace Modules\Welcome\Database;

use App\Model;
use App\Traits\Imageable;

class Welcome extends Model
{
	use Imageable;

	protected $connection = 'psc';
	protected $fillable = [
		'issue_id',
		'point_id',
		'user_id',
		'published',
	];
#	protected $with = [
#		'images',
#	];
	protected $a_form = [
		'point_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'issue_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
		'image_ids'	=> [
			'tab'		=> 'photo',
			'field'		=> 'image',
			'rules'		=> '',
		],
		'published'		=> [
			'tab'		=> 'manage',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],
	];

	protected static function boot()
	{
		parent::boot();

		static::deleted(function($model) {
			if($model->image)
				File::destroy($model->image->pluck('id')->toArray());
		});
	}
/*
	public function images()
	{
		return $this->morphMany('App\File', 'fileable');
	}
*/

	public function issue()
	{
		return $this->belongsTo('Modules\Issue\Database\Issue');
	}
	public function point()
	{
		return $this->belongsTo('App\Point');
	}
}
