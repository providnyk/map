<?php

namespace App;

use                                  App\Traits\GeneralTrait;
use                Illuminate\Database\Eloquent\Model          as BaseModel;
use           Astrotomic\Translatable\Contracts\Translatable   as TranslatableContract;
use                     Astrotomic\Translatable\Translatable;
use                             Illuminate\Http\Response;
use                             Illuminate\Http\Request;
use                                      Carbon\Carbon;

class Model extends BaseModel
{
	use GeneralTrait;
	use Translatable;

	public $translatedAttributes = [];
	protected static $_model = '';

	# https://stackoverflow.com/questions/30502922/a-construct-on-an-eloquent-laravel-model#30503372
	# The first line (parent::__construct()) will run the Eloquent Model's own construct method
	# before your code runs, which will set up all the attributes for you.
	public function __construct(array $attributes = array())
	{
		parent::__construct($attributes);

		$s_basename					= class_basename(__CLASS__);
#		$this->_env					= (object) [];
		$s_tmp						= get_called_class();

		$a_tmp						= explode('\\', $s_tmp);

		if (stripos($s_tmp,'Translation') === FALSE)
		{
			$s_name						= $a_tmp[1];

			if ($a_tmp[0] == 'Modules')
			{
#				$s_name					= $a_tmp[1];
				$s_model				= '\Modules\\' . $s_name . '\\' . $a_tmp[2] . '\\' . $s_name ;
				$s_trans				= '\Modules\\' . $s_name . '\\' . 'Database' . '\\' . $s_name ;
			}
			else
			{
				$s_name					= str_replace($s_basename, '', $s_name);
				$s_model				= '\App\\'.$s_name;
				$s_trans				= $s_model;
			}
			self::$_model				= $s_model;

#			$m							= new $s_model;
			$s_tmp						= $s_trans.'Translation';

			if (class_exists($s_tmp))
			{
				$t							= new $s_tmp;
				$a_fill_trans				= $t->getFillable();
#				$a_form_main				= $m->getFields();
#				$a_form_trans				= $t->getFields();
				$this->translatedAttributes = $a_fill_trans;
			}
		}
	}

	/**
	 * Unify number formatting
	 *
	 * @param Float		$i_num		Number to be formatted
	 * @param Integer	$i_num		Decimal places
	 *
	 * @return String	formatted number
	 */
	public static function formatNumber(float $i_num, int $i_decimal = NULL) : String
	{
		return number_format($i_num, $i_decimal ?? 0, ',', '’');
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

	public static function getModelNameWithNamespace($s_name)
	{
		$s_model		= ucfirst($s_name);
		$s_model		= '\Modules\\' . $s_model . '\\' . 'Database' . '\\' . $s_model;
		return $s_model;
	}

	/**
	 * Find items that only belong to specified parent’s ids
	 *
	 * @param String	$s_model			the child’s table
	 * @param Bool		$b_published		NULL (default) = all, TRUE/FALSE
	 * @param String	$s_parent			parent name
	 * @param Array		$a_parent			parent identifier(s) that child records will belong to
	 *
	 * @return Array
	 */
	public static function getIdTitleForParent(String $s_model, Bool $b_published = NULL, String $s_parent, Array $a_parent) : Array
	{
		$s_model		= self::getModelNameWithNamespace($s_model);
		$fn_select		= $s_model . '::select';
		$o_items		= $fn_select()->whereIn($s_parent . '_id', $a_parent)->get('title', 'id')->pluck('title', 'id');
		if (!is_null($b_published))
		{
			$o_items	= $o_items->wherePublished($b_published);
		}
		return $o_items->toArray();
	}

	/**
	 * Get 2 columns from DB and organise them for a specific need
	 * @param Request	$request			Data from request
	 * @param Filters	$filters			Whatever filters applied
	 * @param String	$s_model			Model name to retrieve data from
	 * @param Bool		$b_published		NULL (default) = all, TRUE/FALSE
	 * @param Array		$a_include_ids		if only specific ids are needed
	 * @param Array		$a_exclude_ids		if some ids are not needed
	 * @param Bool		$b_sort_bytitle		default sorting is by the key
	 * @param Bool		$b_byid				id will be the key and title will be the value
*/
#	 * @param Bool		$b_json				Data from request
/*	 *
	 * @return Array						set of results
	 */
	public static function getIdTitle(Request $request, $filters, String $s_model, ?Bool $b_published, Array $a_include_ids, Array $a_exclude_ids, Bool $b_sort_bytitle, Bool $b_byid
#		, Bool $b_json
	) : Array
	{
#		$a_element_ids			= Style::findOrFail($i_style_id)->element()->get()->pluck('id')->toArray();
#		$a_issue_ids = Design::findOrFail($i_design_id)->issue()->get()->pluck('id')->toArray();
#		$t_ids = $this->event->translations->pluck('id', 'locale')->toArray();
#		$artists->pluck('id')->toArray()
#		Category::select('type')->distinct()->get()->map->type->toArray(),
#		->keyBy('id')

		/**
		 * 'text' is used when providing data directly to select2
		 * https://select2.org/data-sources/ajax
		*/
		$s_title = 'title';
#		if ($b_json)
#			$s_title = 'text';

		$s_model_path			= self::getModelNameWithNamespace($s_model);
		$fn_select				= $s_model_path . '::select';
		$fn_filter				= $s_model_path . '::filter';


		if (is_null($filters))
			$o_items			= $fn_select('id');
		else
			$o_items			= $fn_filter($filters);

		if (!empty($a_include_ids))
			$o_items			= $o_items->whereIn(strtolower($s_model).'s.id', $a_include_ids);

		if (!empty($a_exclude_ids))
			$o_items			= $o_items->whereNotIn(strtolower($s_model).'s.id', $a_exclude_ids);

		if (!is_null($b_published))
			$o_items			= $o_items->wherePublished($b_published);

		$o_items = $o_items->get()->map( function($o_item) use ($s_title) {
			return ['id' => $o_item->id, $s_title => $o_item->title];
		});

		if ($b_sort_bytitle)
			$o_items			= $o_items->sortBy('title');

#		foreach ($o_items AS $k => $v)
#			dump($k, $v);

#dd($o_items);
		$a_res = [];
		if ($b_byid)
		{
			foreach ($o_items AS $k => $v)
				$a_res[$v['id']]	= $v['title'];

#			for ($i = 0; $i < count($o_items); $i++)
#				$a_res[$o_items[$i]['id']] = $o_items[$i][$s_title];
#			if ($b_sort_bytitle)
#				asort($a_res);
		}
		else
		{
#			$a_res				= $o_items;
#			if ($b_sort_bytitle)
#				$a_res			= $a_res->sortBy('title');
#			$a_res				= $o_items->toArray();
/*
			$a_items = [];
			foreach ($a_res AS $k => $v)# ($i = 0; $i < count($a_items); $i++)
				$a_items[] = ['id' => $k, $s_title => $v];
			$a_res = $a_items;
*/
			foreach ($o_items AS $k => $v)# ($i = 0; $i < count($a_items); $i++)
				$a_res[]			= ['id' => $v['id'], $s_title => $v['title']];
		}
#dd($a_res);
		return $a_res;
	}


	/**
	 * make data into response'ble
	 *
	 * @param Array		$a_response		Model specific
	 *
	 * @return Response					response ready
	 */
	public static function makeResponse($a_response) : Response
	{
		return response($a_response, $a_response['code']);
	}


	public static function _getServerName()
	{
		$a_tmp = explode('.', request()->getHost());
		$a_tmp[0] = strtoupper($a_tmp[0]);
		return $a_tmp[0];
	}

	/**
	 * write debug info to server's log file
	 * @param  String	$s_type			log level: info, warning, error, critical (will also die())
	 * @param  String	$s_info			log info to be writteb
	 * @param  String	$s_time			time level: total, loop, empty = nothing
	 * @param  Int		$i_qty			qty of items to be recalculated for per/hour rate
	 *
	 * @return void
	 */
	public static function writeLog(String $s_type, String $s_info, String $s_time = '', Int $i_qty = NULL) : void
	{
		switch ($s_time)
		{
			case 'total':		$f_time = self::getIntervalSeconds(); break;
			case 'interval':	$f_time = self::timerGetInterval(); break;
			case 'loop':		$f_time = self::getLoop(); break;
			default:			$f_time = 0; break;
		}

		$s_format =		'%7s pid=%-7s %s';
		$a_format_values = [self::_getServerName(), getmypid(), $s_info];

		if (!empty($s_time))
		{
			$s_format .=	' in %8.1fs';
			$a_format_values[] = $f_time;
		}
		if (!empty($i_qty))
		{
			$s_format .=	' at %10s/hour';
			$a_format_values[] = self::formatNumber(self::getPerHourRate($f_time, $i_qty));
		}

		$s_msg = self::_replaceSeparatorForLogging($s_format, $a_format_values);

		switch ($s_type)
		{
			case 'mem':
				if (empty($s_info))
				{
					$s_info = memory_get_usage();
				}
				// Memory usage: 5.65MiB from 4.55 GiB of 23.91 GiB (19.013557664178%)
				$memUsage = self::getServerMemoryUsage(false);
				$s_msg =
				 sprintf('   '.'Memory usage: %s from %s of %s (%s%%)',
					self::getNiceFileSize($s_info),
					self::getNiceFileSize($memUsage['total'] - $memUsage['free']),
					self::getNiceFileSize($memUsage['total']),
					self::getServerMemoryUsage(true)
				);
			case 'info':		\Log::info('     ' . $s_msg); break;
			case 'warning':		\Log::warning('  ' . $s_msg); break;
			case 'error':		\Log::error('    ' . $s_msg); break;
			case 'critical':	\Log::critical(' ' . $s_msg); die(); break;

			break;
		}
	}

	// Returns used memory (either in percent (without percent sign) or free and overall in bytes)
	public static function getServerMemoryUsage($getPercentage=true)
	{
		$memoryTotal = null;
		$memoryFree = null;

		if (stristr(PHP_OS, "win")) {
			// Get total physical memory (this is in bytes)
			$cmd = "wmic ComputerSystem get TotalPhysicalMemory";
			@exec($cmd, $outputTotalPhysicalMemory);

			// Get free physical memory (this is in kibibytes!)
			$cmd = "wmic OS get FreePhysicalMemory";
			@exec($cmd, $outputFreePhysicalMemory);

			if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
				// Find total value
				foreach ($outputTotalPhysicalMemory as $line) {
					if ($line && preg_match("/^[0-9]+\$/", $line)) {
						$memoryTotal = $line;
						break;
					}
				}

				// Find free value
				foreach ($outputFreePhysicalMemory as $line) {
					if ($line && preg_match("/^[0-9]+\$/", $line)) {
						$memoryFree = $line;
						$memoryFree *= 1024;  // convert from kibibytes to bytes
						break;
					}
				}
			}
		}
		else
		{
			if (is_readable("/proc/meminfo"))
			{
				$stats = @file_get_contents("/proc/meminfo");

				if ($stats !== false) {
					// Separate lines
					$stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
					$stats = explode("\n", $stats);

					// Separate values and find correct lines for total and free mem
					foreach ($stats as $statLine) {
						$statLineData = explode(":", trim($statLine));

						//
						// Extract size (TODO: It seems that (at least) the two values for total and free memory have the unit "kB" always. Is this correct?
						//

						// Total memory
						if (count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal") {
							$memoryTotal = trim($statLineData[1]);
							$memoryTotal = explode(" ", $memoryTotal);
							$memoryTotal = $memoryTotal[0];
							$memoryTotal *= 1024;  // convert from kibibytes to bytes
						}

						// Free memory
						if (count($statLineData) == 2 && trim($statLineData[0]) == "MemFree") {
							$memoryFree = trim($statLineData[1]);
							$memoryFree = explode(" ", $memoryFree);
							$memoryFree = $memoryFree[0];
							$memoryFree *= 1024;  // convert from kibibytes to bytes
						}
					}
				}
			}
		}

		if (is_null($memoryTotal) || is_null($memoryFree)) {
			return null;
		} else {
			if ($getPercentage) {
				return (100 - ($memoryFree * 100 / $memoryTotal));
			} else {
				return array(
					'total'	=> $memoryTotal,
					'free'	=> $memoryFree,
				);
			}
		}
	}

	public static function getNiceFileSize($bytes, $binaryPrefix=true) {
		if ($binaryPrefix) {
			$unit=array('B','KiB','MiB','GiB','TiB','PiB');
			if ($bytes==0) return '0 ' . $unit[0];
			return @round($bytes/pow(1024,($i=floor(log($bytes,1024)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
		} else {
			$unit=array('B','KB','MB','GB','TB','PB');
			if ($bytes==0) return '0 ' . $unit[0];
			return @round($bytes/pow(1000,($i=floor(log($bytes,1000)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
		}
	}

	public static function _replaceSeparatorK($s_msg)
	{
		# replace thousand separator which is treated as 2 chars per each symbol by vsprintf otherwise
		# ’
		$s_tmp = str_replace('"', '‘', $s_msg);
		return $s_tmp;
	}

	public static function _replaceSeparatorForLogging($s_format, $a_format_values)
	{
		$s_tmp = self::_replaceSeparatorK(vsprintf($s_format, $a_format_values));
		return $s_tmp;
	}

	public static function download()
	{
		$s_basename					= class_basename(self::$_model);
		$s_category 				= strtolower($s_basename);

		// $s_model		= self::getModelNameWithNamespace($s_model);
// dd($s_basename, $s_category, self::$_model);
		// $fn_select		= $s_model . '::select';
		// $o_items		= $fn_select()->whereIn($s_parent . '_id', $a_parent)->get('title', 'id')->pluck('title', 'id');

		$headers = [
			'Cache-Description'		=> 'File Transfer',
			'Cache-Control'			=> 'must-revalidate, post-check=0, pre-check=0',
			'Content-Type'			=> 'text/csv; charset=UTF-8',
			'Content-Disposition'	=> 'attachment; filename="' . $s_category . '_' . date("Y.m.d_H-i") . '.csv"',
			'Expires'				=> '0',
			'Pragma'				=> 'public',
		];
// dd(self::class);
		return response()->stream([self::$_model, 'streamRecords'], 200, $headers);
	}
}
