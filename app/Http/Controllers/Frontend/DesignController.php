<?php

namespace App\Http\Controllers\Frontend;

use App\Design;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignController extends Controller
{
    public function index(Request $request)
    {
        return view('public.designs.single', [
            'designs' => Design::all()->sortByDesc('created_at'),
        ]);
    }
}
