<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request, $language)
    {
        if (array_key_exists($language, config('translatable.locales'))) {
            session(['lang' => $language]);
        }
        return back();
    }
}
