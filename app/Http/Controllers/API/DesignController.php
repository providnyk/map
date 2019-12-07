<?php

namespace App\Http\Controllers\API;

use App\Design;
use App\Filters\DesignFilters;
use App\Http\Requests\DesignRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\DesignApiRequest;

class DesignController extends Controller
{
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
        $design = Design::create($request->only('enabled', 'uk', 'ru', 'en', 'de'));
#        $design->processImages($request, 'image');

        return response([
            'message' => trans('messages.design_created')
        ], 200);
    }

    public function update(DesignRequest $request, Design $design)
    {
        $design->update($request->only('enabled', 'uk', 'ru', 'en', 'de'));
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
            'message' => trans('common/messages.designs_deleted', $number, ['number' => $number])
        ], 200);
    }
}