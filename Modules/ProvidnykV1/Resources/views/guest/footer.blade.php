<footer>
	<div class="container fullwidth">
		<div class="flexwrap">
			<div class="copyright">
				<p>
					&copy; {!! trans('app.name') !!}
				</p>
				<p>
					@if (config('app.est')!=date("Y")) {{ config('app.est') }} &mdash; @endif
					{!! @date("Y") !!}
				</p>
			</div>
			<div class="eu_visibility">
				<p>
				<a href="https://europa.eu/" target="_blank">
					<img width="67" height="60" src="/images/europa-flag.gif" />
					This website was created and maintained with the financial support of the European Union. Its contents are the sole responsibility of the <strong>Debate for Changes NGO</strong> and do not necessarily reflect the views of the European Union
				</a>
				</p>

@include($theme . '::' . $_env->s_utype . '._confidentiality_info')

			</div>
@include($theme . '::layouts._lang')
@include($theme . '::layouts._social_networks')
		</div>
		{{-- <button class="open_filter_btn">Показать фильтр</button> --}}
		<div class="divider"></div>
	</div>
</footer>
