<?php

namespace Modules\Opinion\User;

use                                   Carbon\Carbon;
use                 Modules\Opinion\Database\Opinion as Model;
use                \Modules\Element\Database\Element;
use                   \Modules\Mark\Database\Mark;

class Opinion extends Model
{
	public $translationModel = '\Modules\Opinion\Database\OpinionTranslation';

	public static function streamRecords()
	{
		$BOM		= "\xEF\xBB\xBF"; // UTF-8 BOM
		$a_columns_read	= [
			'user_id',
			'created_at',
			'id',
		];

		$a_columns_write	= [
			'created_at'		=> trans('user/crud.table.created_at'),
			'user_name'			=> trans('user/user.names.sgl'),
			'user_id'			=> trans('user/crud.field.id.label') . ' ' . trans('user/user.names.txt_create'),
			'title'				=> trans('opinion::crud.names.sgl'),
			'id'				=> trans('user/crud.field.id.label') . ' ' . trans('opinion::crud.names.txt_create'),
		];

		$s_category = strtolower(self::class);

		foreach ($a_columns_write AS $s_name => $s_id)
		{
			if (empty($s_id))
			{
				$a_columns_write[$s_name]		= trans($s_category . '::crud.field.' . $s_name . '.label');
			}
		}
		$a_elements = Element::select()->orderBy('id')->get()->pluck('title', 'id')->toArray();
		$a_marks = Mark::select()->orderBy('id')->get()->pluck('title', 'id')->toArray();

		foreach ($a_elements AS $i_id => $s_name)
		{
			$a_columns_write['opinion_' . $i_id] = $s_name;
		}

		$a_list = self::select($a_columns_read)->with('vote')->orderBy('created_at', 'DESC')->get()->toArray();
		$f = fopen('php://output', 'w');
		fwrite($f, $BOM);

		/**
		 *	add headers for each column in the CSV download
		 */
		fputcsv($f, $a_columns_write);

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

			# fill in opinions selected by user for elements of this place
			foreach ($row['vote'] AS $i_id => $a_vote)
			{
				$row['opinion_' . $a_vote['element_id'] ] = $a_marks[ $a_vote['mark_id'] ];
			}

			# fill in opinions for non-existent elements of this place
			# otherwise a fatal will happen if all values aren't filled
			foreach ($a_elements AS $i_id => $s_name)
			{
				if (!isset($row['opinion_' . $i_id]))
					$row['opinion_' . $i_id] = '';
			}

			$a_data	= [];
			foreach ($a_columns_write AS $s_column_index => $s_column_name) {
				$a_data[$s_column_index] = $row[$s_column_index];
			}
			fputcsv($f, $a_data);
		}
		fclose($f);
    }
}
