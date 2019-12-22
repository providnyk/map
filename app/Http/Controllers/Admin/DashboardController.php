<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {

    	$a_cnt = [];
		foreach (config('elements.list') AS $s_table => $s_model)
		{
			$s_ctrl = '';
			if (in_array($s_table, config('elements.modules')))
				$s_ctrl = '\Modules\\' . $s_model . '\Database\\' . $s_model ;
			else
				$s_ctrl = 'App\\'.$s_model;

			if ($s_model == 'User')
				$s_field = 'active';
			else
				$s_field = 'published';

			$fn_where = $s_ctrl . '::where';
			if (!empty($s_ctrl))
				$a_cnt[$s_model] = $fn_where($s_field, '=', 1)->get()->count()
									.'/'.
									$fn_where($s_field, '=', 0)->get()->count()
									;
		}

        return view('admin.home',
    	[
    		'cnt' => $a_cnt,
    	]);
    }
}
