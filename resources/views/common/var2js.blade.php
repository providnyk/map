let
	s_route_csfr		= '{!! route('get-csrf') !!}'
	,s_route_auth		= '{!! route('guest.personal_profile') !!}'
	,auth				= '{!! Auth::check() ?? null !!}'
	,s_locale			= '{!! $app->getLocale() !!}'
;