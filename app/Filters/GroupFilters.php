<?php

namespace App\Filters;

use DB;
use App\Filters\Filters;
use Illuminate\Http\Request;

class GroupFilters extends Filters
{
	protected $filters = [
		'id',
		'title',
		'created_at',
		'updated_at',
	];

	protected function title($title)
	{
		return $this->builder->whereTranslationLike('title', '%' . $title . '%', $this->appLocale);
	}

	protected function getQuery()
	{
		return $this->builder->select(
				'groups.*',
				'group_translations.title as title'
			)
			->offset($this->request->start)
			->limit($this->limit)
			->leftJoin('group_translations', function($query) {
				$query->on('group_translations.group_id', '=', 'groups.id')
					->where('locale', '=', $this->appLocale);
			})
			->orderBy($this->orderColumn, $this->orderDirection);
	}
}