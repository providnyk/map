<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $_env = [];
	protected $a_fields = [];
	public function setEnv()
	{
		$this->_env = (object) [];
		$s_tmp = get_called_class();
		$a_tmp = explode('\\', $s_tmp);
#dd($a_tmp);
		if ($a_tmp[0] == 'Modules')
		{
			$this->_env->s_name = $a_tmp[1];
			$this->_env->s_model = '\Modules\\' . $this->_env->s_name . '\\' . $a_tmp[2] . '\\' . $this->_env->s_name ;
		}
		else
		{
			$this->_env->s_name = str_replace('Controller', '', $a_tmp[4]);
			$this->_env->s_model = '\App\\'.$this->_env->s_name;
		}

		$this->_env->s_sgl = strtolower($this->_env->s_name);
		$this->_env->fn_find = $this->_env->s_model.'::findOrNew';
		$this->_env->s_plr = request()->segment(2);

		$m = new $this->_env->s_model;
		$this->a_fields = array_merge(config('translatable.locales'), $m->getFillable());
	}
}
