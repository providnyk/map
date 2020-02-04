<?php

namespace Modules\Opinion\Database;

use                                  App\Model;

class Opinion extends Model
{
	protected $connection = 'psc';
	protected $fillable = [



		'place_id',
		'user_id',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> '',
		],










		'place_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> '',
		],
	];















	public function place()
	{
		return $this->belongsTo('Modules\Place\Database\Place');
	}
	public function user()
	{
		return $this->belongsTo('App\User');
	}
    public function vote()
    {
        return $this->hasMany('Modules\Opinion\Database\OpinionVote');
    }

}
