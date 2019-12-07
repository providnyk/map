<?php

namespace App\Http\Middleware;

use Closure;
use App\NewsTranslation;
use App\EventTranslation;
use App\FestivalTranslation;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = session('lang', config('app.fallback_locale'));

//        if ($request->slug && ! $request->festival_slug) {
//            if ($request->is('*event/*')) {
//                $locale = EventTranslation::where('slug', $request->slug)->firstOrFail()->locale;
//            } else if ($request->is('*/post')) {
//                $locale = NewsTranslation::where('slug', $request->slug)->firstOrFail()->locale;
//            }
//        } else if ($request->festival_slug) {
//            $locale = FestivalTranslation::where('slug', $request->festival_slug)->firstOrFail()->locale;
//        }

        app()->setlocale($locale);

        setlocale(LC_TIME, $locale);
        
        return $next($request);
    }
}
