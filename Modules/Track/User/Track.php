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
		$a_columns	= [
			'created_at'	=> trans('cms.column-created_at'),
			'id'			=> trans('cms.column-nro-jd'),
			// 'title'			=> trans('cms.column-legal_code'),
		];

	    $a_list = self::select(array_keys($a_columns))->orderBy('created_at', 'DESC')->get()->toArray();

		$f = fopen('php://output', 'w');
		fwrite($f, $BOM);

		/**
		 *	add headers for each column in the CSV download
		 */
		fputcsv($f, $a_columns);

		foreach ($a_list as $row) {
			$row['created_at']	= Carbon::parse($row['created_at'])->format("d/m/y");
			// fputcsv($f, $row);
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
