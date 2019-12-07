let
	auth 				= '{!! Auth::check() ?? null !!}'
    ,route_favorite		= '{!! route('public.event.favorite', ':event') ?? null !!}'
    ,route_login		= '{!! route('login') ?? null !!}'
	,s_app_locale_code	= '{{ $app->getLocale() ?? null }}'
	,records_total		= {{ $records_total ?? 0 }}
    ,route_unfavorite 	= '{!! route('public.event.unfavorite', ':event') ?? null !!}'
;