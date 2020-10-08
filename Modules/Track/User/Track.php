<?php

namespace Modules\Track\User;

use                                   Carbon\Carbon;
use                   Modules\Track\Database\Track as Model;

class Track extends Model
{
	public $translationModel = '\Modules\Track\Database\TrackTranslation';

	public static function streamRecords()
	{
		$BOM		= "\xEF\xBB\xBF"; // UTF-8 BOM
		$a_columns_read	= [
			'user_id',
			'created_at',
			'travel_mode',
			'length',
			'time',
			'route_qty',
			'route_selected',
			'response_status',
			'from_lat',
			'from_lng',
			'to_lat',
			'to_lng',
			'id',
		];

		$a_columns_write	= [
			'created_at'		=> trans('user/crud.table.created_at'),
			'user_name'			=> '',
			'from_address'		=> '',
			'to_address'		=> '',
			'travel_mode'		=> '',
			'length'			=> '',
			'time'				=> '',
			'route_qty'			=> '',
			'route_selected'	=> '',
			'response_status'	=> '',
			'from_lat'			=> '',
			'from_lng'			=> '',
			'to_lat'			=> '',
			'to_lng'			=> '',
			'user_id'			=> '',
			'id'				=> trans('user/crud.field.id.label'),
		];

		$s_category = 'track';

		foreach ($a_columns_write AS $s_name => $s_id)
		{
			if (empty($s_id))
			{
				$a_columns_write[$s_name]		= trans($s_category . '::crud.field.' . $s_name . '.label');
			}
		}
	    $a_list = self::select($a_columns_read)->orderBy('created_at', 'DESC')->get()->toArray();
		$f = fopen('php://output', 'w');
		fwrite($f, $BOM);

		/**
		 *	add headers for each column in the CSV download
		 */
		fputcsv($f, array_merge($a_columns_write));

		/**
		 * Users are not a Module yet
		 * so have to arrange a crutch for user name to be shown
		 */
		$a_user_ids = [];
		for ($i = 0; $i < count($a_list); $i++)
			$a_user_ids[] = $a_list[$i]['user_id'];
		$o_users = \App\User::select('id', \DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
								->whereIn('id', $a_user_ids)
								->pluck('full_name', 'id')
							;
		for ($i = 0; $i < count($a_list); $i++)
			$a_list[$i]['user_name'] = (!is_null($a_list[$i]['user_id']) ? $o_users[$a_list[$i]['user_id']] : 'anonymous');

		/**
		 * Actual data
		 */
		foreach ($a_list as $row) {
			unset($row['translations']);
			$row['created_at']	= Carbon::parse($row['created_at'])->format("d/m/y H:i:s");
			$a_data	= [];
			foreach ($a_columns_write AS $s_column_index => $s_column_name) {
				$a_data[$s_column_index] = $row[$s_column_index];
			}
			fputcsv($f, $a_data);
		}
		fclose($f);
    }

    public static function download()
    {
		$headers = [
			'Cache-Description'		=> 'File Transfer',
			'Cache-Control'			=> 'must-revalidate, post-check=0, pre-check=0',
			'Content-Type'			=> 'text/csv; charset=UTF-8',
			'Content-Disposition'	=> 'attachment; filename="track_' . date("Y.m.d_H-i") . '.csv"',
			'Expires'				=> '0',
			'Pragma'				=> 'public',
		];
		return response()->stream([self::class, 'streamRecords'], 200, $headers);
    }
}