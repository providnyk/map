<?php

namespace App\Http\Controllers\API;

use App\Design;
use App\DesignTranslation;
use App\Filters\DesignFilters;
use App\Http\Requests\DesignRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\DesignApiRequest;

class DesignController extends Controller
{
	protected $a_fields = [];
	public function __construct()
	{
#		dump($this->translatedAttributes);
#		$t = new DesignTranslation;
#		$this->translatedAttributes = $m->getFillable();
		$m = new Design;
	    $this->a_fields = array_merge(config('translatable.locales'), $m->getFillable());
	}
/*
*/
    public function index(DesignApiRequest $request, DesignFilters $filters)
    {
        return response([
            'draw'              => $request->draw,
            'data'              => Design::filter($filters)->get(),
            'recordsTotal'      => Design::count(),
            'qty_filtered'      => $filters->getFilteredCount(),
        ], 200);
    }

    public function store(DesignRequest $request)
    {
/*
		$m = new Design;
		dump($m->translatedAttributes);
		$t = new DesignTranslation;
		$m->translatedAttributes = $t->getFillable();
#	    $this->translatedAttributes = array_merge($this->translatedAttributes, $m->getFillable());
		dd($m->translatedAttributes);
*/
#        $design = Design::create($request->only($m->translatedAttributes));
#		dd(config('translatable.locales'));
#		dump($this->a_fields);
        $design = Design::create($request->only($this->a_fields));
#        $design->processImages($request, 'image');

        return response([
            'message' => trans('messages.design_created')
        ], 200);
    }

    public function update(DesignRequest $request, Design $design)
    {
        $design->update($request->only($this->a_fields));
#        $design->update($request->only('enabled', 'uk', 'ru', 'en', 'de'));
#        $design->processImages($request, 'image');

        return response([
            'message' => trans('messages.design_updated')
        ], 200);
    }

    public function destroy(DeleteRequest $request)
    {
        Design::destroy($request->ids);

        $number = count($request->ids);

        return response([
            'message' => trans('common/messages.designs_deleted', ['number' => $number], $number)
        ], 200);
    }
}