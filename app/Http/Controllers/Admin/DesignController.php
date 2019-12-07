<?php

namespace App\Http\Controllers\Admin;

use App\Design;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DesignController extends Controller
{
    public function index()
    {
        return view('admin.designs.list', [
            'designs'			=> Design::all()->sortByDesc('created_at'),
            'dates'             => Design::getTimestampDates(),
        ]);
    }

    public function form(Request $request)
    {
        $this->validate($request, [
            'id' => 'integer'
        ]);

        return view('admin.designs.form', [
            'design'              => Design::findOrNew($request->id),
        ]);
    }
}
