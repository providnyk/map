<footer>
	<div class="container fullwidth">
		<div class="flexwrap">
			<p class="copyright">
				{!! trans('app.name') !!} &copy;
				@if (config('app.est')!=date("Y")) {{ config('app.est') }} &mdash; @endif
				{!! @date("Y") !!}
			</p>
@include($theme . '::layouts._lang')
@include($theme . '::layouts._social_networks')
		</div>
		<button class="open_filter_btn">Показать фильтр</button>
		<div class="divider"></div>
	</div>
</footer>
