<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait LocaleTrait
{

    /**
     * Update configs with actual data of available locales basing on translations present in directoris of "lang" folder
     *
     * @return void
     */
	private function _L10N2config() : void
	{
		$s_path = base_path().'/resources/lang';
		$a_files = File::directories($s_path);
		$a_files = File::allFiles($s_path);
		$a_dirs = [];
		$a_L10N = [];

		foreach ($a_files as $o_file)
		{
			$s_abbr = $o_file->getRelativePath();
			if (strlen($s_abbr) != 2)
				$s_abbr = '';
			if (!empty($s_abbr))
			{
				if ($o_file->getFilename() == 'app.php')
				{
				$a_tmp = include($o_file->getPathname());
				if (isset($a_tmp['lang']['this']))
					$a_dirs[$s_abbr] = $a_tmp['lang']['this'];
				}
				if(!isset($a_dirs[$s_abbr]))
					$a_dirs[$s_abbr] = NULL;
			}
		}

		foreach ($a_dirs as $s_abbr => $s_name)
		{
			if (app()->getLocale() == $s_abbr)
				$a_L10N[$s_abbr] = trans('app.lang.this');
			elseif (trans('app.lang.'.$s_abbr) != 'app.lang.'.$s_abbr)
				$a_L10N[$s_abbr] = trans('app.lang.'.$s_abbr);
			elseif (!is_null($a_dirs[$s_abbr]))
				$a_L10N[$s_abbr] = $a_dirs[$s_abbr];
			else
				$a_L10N[$s_abbr] = mb_strtoupper($s_abbr);
		}

		config(['translatable' => [
					'locales' => array_keys($a_L10N),
					'names' => $a_L10N,
				]]);
	}

}