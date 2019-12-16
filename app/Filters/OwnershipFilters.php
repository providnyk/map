<?php

namespace App\Filters;

use DB;
use App\Filters\Filters;
use Illuminate\Http\Request;

class OwnershipFilters extends Filters
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
				'ownerships.*',
				'ownership_translations.title as title'
			)
			->offset($this->request->start)
			->limit($this->limit)
			->leftJoin('ownership_translations', function($query) {
				$query->on('ownership_translations.ownership_id', '=', 'ownerships.id')
					->where('locale', '=', $this->appLocale);
			})
			->orderBy($this->orderColumn, $this->orderDirection);
	}
}