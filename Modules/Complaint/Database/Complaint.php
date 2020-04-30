<?php

namespace Modules\Complaint\Database;

use                                      App\Model;

class Complaint extends Model
{
	protected $connection = 'psc';
	protected $fillable = [
		'place_id',
		'published',
	];
	public $translatedAttributes = [];
	protected $a_form = [
		'published'		=> [
			'tab'		=> 'data',
			'field'		=> 'checkbox',
			'rules'		=> 'boolean',
			'default'	=>	TRUE,
		],
		'place_id'		=> [
			'tab'		=> 'data',
			'field'		=> 'select',
			'rules'		=> 'required|integer',
		],
	];

    public function place()
    {
        return $this->HasMany('Modules\Place\Database\Place');
    }
}
