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

	# https://stackoverflow.com/questions/30502922/a-construct-on-an-eloquent-laravel-model#30503372
	# The first line (parent::__construct()) will run the Eloquent Model's own construct method
	# before your code runs, which will set up all the attributes for you.
	public function __construct(array $attributes = array())
	{
		parent::__construct($attributes);

		$s_basename					= class_basename(__CLASS__);
#		$this->_env					= (object) [];
		$s_tmp						= get_called_class();
#dd($s_tmp);
		$a_tmp						= explode('\\', $s_tmp);
#dump(stripos($a_tmp[1],'Translation') === FALSE);
		if (stripos($s_tmp,'Translation') === FALSE)
		{
			$s_name						= $a_tmp[1];
	#dump($s_name);
			if ($a_tmp[0] == 'Modules')
			{
	#			$s_name					= $a_tmp[1];
	#			$s_model	= '\Modules\\' . $s_name . '\\' . $a_tmp[2] . '\\' . $s_name ;
				$s_trans				= '\Modules\\' . $s_name . '\\' . 'Database' . '\\' . $s_name ;
			}
			else
			{
				$s_name					= str_replace($s_basename, '', $s_name);
				$s_model				= '\App\\'.$s_name;
				$s_trans				= $s_model ;
			}

	#		$m							= new $s_model;
			$s_tmp						= $s_trans.'Translation';

			if (class_exists($s_tmp))
			{
				$t							= new $s_tmp;
				$a_trans					= $t->getFillable();
		#		$a_form_main				= $m->getFields();
		#		$a_form_trans				= $t->getFields();
				$this->translatedAttributes = $a_trans;
#dd($a_trans, $this->translatedAttributes);
#dump($this);
			}
		}
#dd(		$a_tmp);
	}

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
