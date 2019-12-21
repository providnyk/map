<?php

namespace App;

use App\Traits\GeneralTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
	use GeneralTrait;
	use Translatable;

	public $translatedAttributes = [];

	public function scopeFilter($query, $filters)
	{
		return $filters->apply($query);
	}

	public function getFields()
	{
		return $this->a_form;
	}

	/**
	 * check possible boolean values in submitted form and set them to request
	 * so that checkboxes can be saved correctly
	 *
	 * @param Request	$request		Model specific
	 *
	 * @return Request	as per Model specific
	 */
	public static function _addBoolsValuesFromForm($request)
	{
		$request->merge([
			'published' => !! $request->published,
		]);
	}
}
