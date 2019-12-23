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
/*
	public function __construct()
	{
		$s_basename					= class_basename(__CLASS__);
#		$this->_env					= (object) [];
		$s_tmp						= get_called_class();
#dd($s_tmp);
		$a_tmp						= explode('\\', $s_tmp);
#dump(stripos($a_tmp[1],'Translation') === FALSE);
		if (stripos($s_tmp,'Translation') !== FALSE)
			return TRUE;
#dd(		$a_tmp);

#		$this->_env->s_name			= $a_tmp[1];
#dump($this->_env->s_name);
		if ($a_tmp[0] == 'Modules')
		{
#			$this->_env->s_name		= $a_tmp[1];
#			$this->_env->s_model	= '\Modules\\' . $this->_env->s_name . '\\' . $a_tmp[2] . '\\' . $this->_env->s_name ;
			$s_trans				= '\Modules\\' . $a_tmp[1] . '\\' . 'Database' . '\\' . $a_tmp[1] ;
		}
		else
		{
#			$this->_env->s_name		= str_replace($s_basename, '', $a_tmp[1]);
#			$this->_env->s_model	= '\App\\'.$this->_env->s_name;
			$s_trans				= $a_tmp[1] ;
		}

#		$m							= new $this->_env->s_model;
		$s_tmp						= $s_trans.'Translation';
dump($s_tmp);
		$t							= new $s_tmp;
		$a_trans					= $t->getFillable();
#		$a_form_main				= $m->getFields();
#		$a_form_trans				= $t->getFields();

		$this->translatedAttributes = $a_trans;
	}
*/
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
