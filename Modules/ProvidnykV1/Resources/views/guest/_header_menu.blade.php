			<nav>
				<ul>
{{--
					<li><a href="#">Про нас</a></li>
					<li><a href="#">Волонтерам</a></li>
					<li><a href="#">Новости</a></li>
					<li><a href="#">Контакты</a></li>
--}}
					@if(Auth::user())
					<li><a class="blue"  href="{!! route('public.cabinet') !!}">{!! trans('general.my-area') !!}</a></li>
					@else
					<li><a class="blue"  href="{!! route('signup_page') !!}">Присоединиться</a></li>
					<li><a class="green" href="{!! route('signin_page') !!}">Вход</a></li>
					@endif
				</ul>
				<ul class="socials">
					<li><a href="#"><img src="{!! $theme !!}/img/soc_fb.png" alt=""></a></li>
					<li><a href="#"><img src="{!! $theme !!}/img/soc_insta.png" alt=""></a></li>
					<li><a href="#"><img src="{!! $theme !!}/img/soc_yt.png" alt=""></a></li>
				</ul>
{{--
				<ul class="language">
					<li><a class="active" href="#">РУССКИЙ</a></li>
					<li><a href="#">УКРАЇнська</a></li>
				</ul>
--}}
			</nav>
			<button class="open_menu"><span></span><span></span><span></span></button>
