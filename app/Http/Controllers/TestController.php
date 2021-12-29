<?php

namespace App\Http\Controllers;

use App\Festival;
use Illuminate\Http\Request;
use \Illuminate\View\View;

class TestController extends Controller
{
    function index() : View
    {
        return view('layouts.test', [
            'public.test' => [1,2,3]
        ]);
    }
}
