<footer>
	<div class="container fullwidth">
		<div class="flexwrap">
			<p class="copyright">
				{!! trans('app.name') !!} &copy;
				@if (env('APP_EST')!=date("Y")) {{ env('APP_EST') }} &mdash; @endif
				{!! @date("Y") !!}
			</p>
{{--
			<ul class="language">
				<li><a class="active" href="#">РУССКИЙ</a></li>
				<li><a href="#">УКРАЇнська</a></li>
			</ul>
--}}
{{--
			<ul class="socials">
				<li><a href="#"><img src="{!! $theme !!}/img/soc_fb.png" alt=""></a></li>
				<li><a href="#"><img src="{!! $theme !!}/img/soc_insta.png" alt=""></a></li>
				<li><a href="#"><img src="{!! $theme !!}/img/soc_yt.png" alt=""></a></li>
			</ul>
--}}
		</div>
		<button class="open_filter_btn">Показать фильтр</button>
		<div class="divider"></div>
	</div>
</footer>
